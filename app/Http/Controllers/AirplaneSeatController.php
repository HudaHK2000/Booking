<?php

namespace App\Http\Controllers;

use App\Models\AirplaneSeat;
use App\Models\Airplane;
use App\Models\TravelClass;
use Illuminate\Http\Request;

class AirplaneSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AirplaneSeat  $airplaneSeat
     * @return \Illuminate\Http\Response
     */
    public function show(AirplaneSeat $airplaneSeat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AirplaneSeat  $airplaneSeat
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AirplaneSeat  $airplaneSeat
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AirplaneSeat  $airplaneSeat
     * @return \Illuminate\Http\Response
     */
    public function destroy(AirplaneSeat $airplaneSeat)
    {
        //
    }
}
