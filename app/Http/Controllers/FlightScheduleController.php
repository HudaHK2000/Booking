<?php

namespace App\Http\Controllers;

use App\Models\FlightSchedule;
use App\Models\Direction;
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
        return view('dashboard.flightSchedule.create',compact('directions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $direction = Direction::find($request->airports);
        $flightSchedule = new FlightSchedule();
        $flightSchedule->origin_airport_code = $direction->origin_airport_code ;
        $flightSchedule->destination_airport_code = $direction->destination_airport_code ;
        $flightSchedule->departure_time = $request->departure_time ;
        $flightSchedule->arrival_time = $request->arrival_time ;
        $flightSchedule->save();
        return redirect()->back()->with('success','The addition process was completed successfully.');
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
        return view('dashboard.flightSchedule.edit',compact(['flightSchedule','directions']));
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
        $flightSchedule->origin_airport_code = $direction->origin_airport_code ;
        $flightSchedule->destination_airport_code = $direction->destination_airport_code ;
        $flightSchedule->departure_time = $request->departure_time ;
        $flightSchedule->arrival_time = $request->arrival_time ;
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