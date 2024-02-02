<?php

namespace App\Http\Controllers;

use App\Models\FlightSchedule;
use App\Models\Direction;
use App\Models\Airline;
use App\Models\Airplane;
use App\Models\FlightStatu;
use App\Models\FlightSeatPrice;
use App\Models\Airport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\ImageTrait;

use Illuminate\Http\Request;

class FlightScheduleController extends Controller
{
    use ImageTrait ;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flightSchedules = FlightSchedule::with('direction');
        if($request->search_origin_airport){
            $flightSchedules= $flightSchedules->
            whereHas('direction.originAirport', function($query) use($request) {
                $query->where('id',$request->search_origin_airport);
            });
        }
        if($request->search_destination_airport){
            $flightSchedules= $flightSchedules->
            whereHas('direction.destinationAirport', function($query) use($request) {
                $query->where('id',$request->search_destination_airport);
            });
        }
        if($request->search_airline){
            $flightSchedules= $flightSchedules->
                whereHas('airplaneFlight.airline', function($query) use($request) {
                    $query->Where('id',$request->search_airline);
                });
        }
        if($request->search_airplane){
            $flightSchedules= $flightSchedules->
                whereHas('airplaneFlight', function($query) use($request) {
                    $query->Where('id',$request->search_airplane);
                });
        }
        if($request->search_flight_status){
            $flightSchedules= $flightSchedules->
                whereHas('flightStatu', function($query) use($request) {
                    $query->Where('id',$request->search_flight_status);
                });
        }
        if($request->searchDateDeparture){
            $flightSchedules = $flightSchedules->whereDate('departure_time', '>=', $request->searchDateDeparture.' 00:00:00');
            $flightSchedules = $flightSchedules->whereDate('departure_time', '<=', $request->searchDateDeparture.' 23:59:59');
        }
        if($request->searchDateArrival){
            $flightSchedules = $flightSchedules->where('arrival_time', '>=', $request->searchDateArrival.' 00:00:00');
            $flightSchedules = $flightSchedules->where('arrival_time', '<=', $request->searchDateArrival.' 23:59:59');
        }
        $flightSchedules = $flightSchedules->get();
        $airports = Cache('airports');
        $airlines = Cache('airlines');
        $airplanes = Cache('airplanes');
        $flightStatus = Cache('flightStatu');
        // dd($flightStatu);
        return view('dashboard.flightSchedule.index',compact(['flightSchedules','airports','airlines','airplanes','flightStatus']));
    }
    public function updateFlightStatus(Request $request){
        // dd($flightId,$request->newStatusId);

        try{
            $flightSchedule = FlightSchedule::find($request->flightId);
            $flightSchedule->update(['flight_status_id' => $request->newStatusId]);
            return response()->json(['state'=> true , 'message'=>'Flight status updated successfully'],200);
        }
        catch(\Exception $e){
            return response()->json(['state'=> false , 'message'=> $e->getMessage()],500);
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directions = Direction::all();
        $airlines = Airline::all();
        $airplanes = Airplane::all();
        return view('dashboard.flightSchedule.create',compact(['directions','airlines','airplanes']));
    }
    public function getAirplanesByAirline($airlineId){
        $airplanes = Airplane::where('airline_id', $airlineId)->get();  
        return response()->json($airplanes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'airports' => ['required'],
            'image' => ['required'],
            'airline' => ['required'],
            'airplane' => ['required'],
            'departure_time' => [
                'required',
                function ($attribute, $value, $fail) use ($request){
                    if (strtotime($value) <= time()) {
                        $fail('The '.$attribute.' must be a date and time after the current date and time.');
                    }
                },
            ],
            'arrival_time' => [
                'required',
                'different:departure_time',
                // يجب ان يكون وقت الوصول اكبر/بعد الوقت الحالي و تاريخ ووقت المغادرة او الاقلاع
                function ($attribute, $value, $fail) use ($request) {
                    //  فحص ما إذا كان وقت الوصول اصغر من الوقت الحالي فيعطي رسالة خطأ
                    if (strtotime($value) <= time()) {
                        $fail('The '.$attribute.' must be a date and time after the current date and time.');
                    }
                    //  فحص ما إذا كان وقت الوصول اصغر من وقت المغادرة فيعطي رسالة خطأ
                    if (strtotime($value) <= strtotime($request->input('departure_time'))) {
                        $fail('The '.$attribute.' must be a date and time after the departure time.');
                    }
                    // Custom validation to check for duplicate airplane flights
                    $airplane = $request->input('airplane');
                    // فحص ما اذا كان هناك موعد اخر لذات الطائرة يحمل ذات القيمة و فحص ما اذا كان هناك وقت اخر بين وقتي المغادرة والوصول
                    $duplicateFlights = FlightSchedule::where('airplane_id', $airplane)
                    ->where(function ($query) use ($value, $request) {

                        $query->where(function ($query) use ($value, $request) {

                            $query->where('departure_time', '<', $value)
                                ->where('arrival_time', '>', $request->input('departure_time'));
                        })
                        ->orWhere(function ($query) use ($value, $request) {
                            $query->where('departure_time', '<', $request->input('arrival_time'))
                                ->where('arrival_time', '>', $value);
                        });
                    })->count();
                    if ($duplicateFlights > 0) {
                        $fail('There is a duplicate flight for the same airplane within the specified departure and arrival times.');
                    }
                },]
        ]
            ,[])->validate();
            // dd($request->airplane);
        $direction = Direction::find($request->airports);
        $flightSchedule = new FlightSchedule();
        $flightSchedule->direction_id = $direction->id ;
        $flightSchedule->image = $this->verifyAndUpload($request , 'image' , 'flightImage');
        $flightSchedule->airplane_id = $request->airplane ;
        $flightSchedule->departure_time = $request->departure_time ;
        $flightSchedule->arrival_time = $request->arrival_time ;
    
        $flight_status = FlightStatu::where('name','Waiting')->first();
        $flightSchedule->flight_status_id = $flight_status->id ;
        $flightSchedule->save();
        return redirect()->back()->with('success','The addition flight to the schedule was completed successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlightSchedule  $flightSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(FlightSchedule $flightSchedule)
    {
        // اعادة انواع الكراسي للطائرة الذاهبة بهذه الرحلة
        $classes = FlightSeatPrice::where('flight_id', $flightSchedule->id)
        ->with('seat.travelClass')
        ->get()
        ->pluck('seat.travelClass')
        ->unique('id');
        // جلب اسعار الكراسي لهذه الطائرة
        for( $i = 0 ; $i < 4 ; $i++){
            $price[$i] = FlightSeatPrice::where('flight_id', $flightSchedule->id)
            ->whereHas('seat', function($query) use ($i) {
                $query->where('travel_class_id', $i+1 );
            })->first();
        }
        // معرفة عدد الكراسي في كل نوع من انواع الكراسي
        $allSeat = [];
        foreach($classes as $class) {
            $allSeat[$class->name] = FlightSeatPrice::where('flight_id', $flightSchedule->id)
            ->whereHas('seat', function($query) use ($class) {
                $query->where('travel_class_id', $class->id);
            })->count();
        }
        // dd($allSeat);
        // جلب عدد الكراسي غير المحجوزة لكل نوع في هذه الرحلة
        $seatsCount = [];
        foreach($classes as $class) {
            $seatsCount[$class->name] = FlightSeatPrice::where('flight_id', $flightSchedule->id)
                ->where('book', 1) // حجزت
                ->whereHas('seat', function($query) use ($class) {
                    $query->where('travel_class_id', $class->id);
                })->count();
        }
        return view('dashboard.flightSchedule.show',compact(['flightSchedule','price','seatsCount','allSeat']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlightSchedule  $flightSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flightSchedule = FlightSchedule::find($id);
        $directions = Direction::all();
        $airlines = Airline::all();
        $airplanes = Airplane::all();
        return view('dashboard.flightSchedule.edit',compact(['flightSchedule','directions','airlines','airplanes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlightSchedule  $flightSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,FlightSchedule $flightSchedule)
    {
        // $flightSchedule = FlightSchedule::find($id);

        $validator = Validator::make($request->all(), [
            'airports' => ['required'],
            'airline' => ['required'],
            'airplane' => ['required'],
            'departure_time' => [
                'required',
                function ($attribute, $value, $fail) use ($request){
                    if (strtotime($value) <= time()) {
                        $fail('The '.$attribute.' must be a date and time after the current date and time.');
                    }
                },
            ],
            'arrival_time' => [
                'required',
                'different:departure_time',
                // يجب ان يكون وقت الوصول اكبر/بعد الوقت الحالي و تاريخ ووقت المغادرة او الاقلاع
                function ($attribute, $value, $fail) use ($request) {
                    //  فحص ما إذا كان وقت الوصول اصغر من الوقت الحالي فيعطي رسالة خطأ
                    if (strtotime($value) <= time()) {
                        $fail('The '.$attribute.' must be a date and time after the current date and time.');
                    }
                    //  فحص ما إذا كان وقت الوصول اصغر من وقت المغادرة فيعطي رسالة خطأ
                    if (strtotime($value) <= strtotime($request->input('departure_time'))) {
                        $fail('The '.$attribute.' must be a date and time after the departure time.');
                    }
                    // Custom validation to check for duplicate airplane flights
                    $airplane = $request->input('airplane');
                    // فحص ما اذا كان هناك موعد اخر لذات الطائرة يحمل ذات القيمة و فحص ما اذا كان هناك وقت اخر بين وقتي المغادرة والوصول
                    $duplicateFlights = FlightSchedule::where('airplane_id', $airplane)->where('id','<>',$request->id)
                    ->where(function ($query) use ($value, $request) {
                        $query->where(function ($query) use ($value, $request) {
                            $query->where('departure_time', '<', $value)
                                ->where('arrival_time', '>', $request->input('departure_time'));
                        })
                        ->orWhere(function ($query) use ($value, $request) {
                            $query->where('departure_time', '<', $request->input('arrival_time'))
                                ->where('arrival_time', '>', $value);
                        });
                    })->count();
                    if ($duplicateFlights > 0) {
                        $fail('There is a duplicate flight for the same airplane within the specified departure and arrival times.');
                    }
                },]
        ]
            ,[])->validate();
        
        $direction = Direction::find($request->airports);
        if (!empty ($request->file('image'))) {
            if(\File::exists(public_path('flightImage/').$flightSchedule->image)){
                \File::delete(public_path('flightImage/').$flightSchedule->image);
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();

            $request->file('image')->move(public_path('flightImage'), $imageName);
            $flightSchedule->image= $imageName;
        }
        $flightSchedule->direction_id = $direction->id ;
        $flightSchedule->airplane_id = $request->airplane ;
        $flightSchedule->departure_time = $request->departure_time ;
        $flightSchedule->arrival_time = $request->arrival_time ;
        $flight_status = FlightStatu::where('name','Waiting')->first();
        $flightSchedule->flight_status_id = $flight_status->id ;
        $flightSchedule->save();
        return redirect()->back()->with('success','The modification was completed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlightSchedule  $flightSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flightSchedule = FlightSchedule::find($id);
        if(\File::exists(public_path('flightImage/').$flightSchedule->image)){
            \File::delete(public_path('flightImage/').$flightSchedule->image);
        }
        $flightSchedule->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    }
}
