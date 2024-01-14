<?php

namespace App\Http\Controllers;

use App\Models\FlightSchedule;
use App\Models\Direction;
use App\Models\Airline;
use App\Models\Airplane;
use App\Models\FlightStatu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class FlightScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flightSchedules = FlightSchedule::all();
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
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) <= time()) {
                        $fail('The '.$attribute.' must be a date and time after the current date and time.');
                    }
                    if (strtotime($value) <= strtotime($request->input('departure_time'))) {
                        $fail('The '.$attribute.' must be a date and time after the departure time.');
                    }
                    // Custom validation to check for duplicate airplane flights
                    $airplane = $request->input('airplane');
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
            ],[])->validate();
            // dd($request->airplane);
        $direction = Direction::find($request->airports);
        $flightSchedule = new FlightSchedule();
        $flightSchedule->direction_id = $direction->id ;
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
        //
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
    public function update(Request $request,$id)
    {
        $direction = Direction::find($request->airports);
        $flightSchedule = FlightSchedule::find($id);
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
        $flightSchedule->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    }
}
