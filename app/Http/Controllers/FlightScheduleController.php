<?php

namespace App\Http\Controllers;

use App\Models\FlightSchedule;
use App\Models\Direction;
use App\Models\Airline;
use App\Models\Airplane;
use App\Models\FlightStatu;
use App\Models\FlightSeatPrice;
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
    public function index()
    {
        $flightSchedules = FlightSchedule::paginate(4);
        return view('dashboard.flightSchedule.index',compact('flightSchedules'));

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
        $classes = FlightSeatPrice::where('flight_id', $flightSchedule->id)
        ->with('seat.travelClass')
        ->get()
        ->pluck('seat.travelClass')
        ->unique('id');
        // dd($classes);
        for( $i = 0 ; $i < 4 ; $i++){
            $price[$i] = FlightSeatPrice::where('flight_id', $flightSchedule->id)
            ->whereHas('seat', function($query) use ($i) {
                $query->where('travel_class_id', $i+1 );
            })->first();
        }
        $allSeat = [];
        foreach($classes as $class) {
            $allSeat[$class->name] = FlightSeatPrice::where('flight_id', $flightSchedule->id)
            ->whereHas('seat', function($query) use ($class) {
                $query->where('travel_class_id', $class->id);
            })->count();
        }
        // dd($allSeat);
        $seatsCount = [];
        foreach($classes as $class) {
            $seatsCount[$class->name] = FlightSeatPrice::where('flight_id', $flightSchedule->id)
                ->where('book', 1) // حجزت
                ->whereHas('seat', function($query) use ($class) {
                    $query->where('travel_class_id', $class->id);
                })->count();
        }

        // الآن يمكنك عرض عدد الكراسي التي تم حجزها لكل نوع من الأنواع
        // dd($seatsCount);

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
