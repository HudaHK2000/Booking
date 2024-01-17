<?php

namespace App\Http\Controllers;

use App\Models\FlightSeatPrice;
use App\Models\FlightSchedule;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class FlightSeatPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($flightSchedule_id)
    {
        $flightSchedule = FlightSchedule::find($flightSchedule_id);
        // dd($flightSchedule , $flightSchedule->airplaneFlight->model ,$flightSchedule->airplaneFlight->airplaneSeats);
        return view('dashboard.flightSeatPrice.create',compact('flightSchedule'));
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
            'business_class' => ['required'],
            'first_class' => ['required'],
            'premium_economy_class' => ['required'],
            'economy_class' => ['required'],
        ]
            ,[])->validate();
            // $flightSchedule = FlightSchedule::find($request->flight_id);
            // $number_of_seats = $flightSchedule->airplaneFlight->number_of_seats;
            // if(isset($number_of_seats)){
            //     for( $i = 1 ; $i <= $number_of_seats ; $i++){
            //         $flight_seat_price = new FlightSeatPrice();
            //         $flight_seat_price->flight_id = $flightSchedule->id;

            //         $seat_id = $flightSchedule->whereHas('airplaneFlight', function($query) use ($request) {
            //                 $query->whereHas('airplaneSeats', function($query) use ($request) {
            //                         $query->where('seat_id', $i)->first();
            //                     });
            //             });
            //         $flight_seat_price->airplane_seat_id = $seat_id->id;
            //         if($seat_id->travel_class_id  == 1 ){
            //             $flight_seat_price->price = $request->economy_class;
            //         }elseif($seat_id->travel_class_id == 2 ){
            //             $flight_seat_price->price = $request->premium_economy_class;
            //         }elseif($seat_id->travel_class_id == 3 ){
            //             $flight_seat_price->price = $request->first_class;
            //         }elseif($seat_id->travel_class_id == 4 ){
            //             $flight_seat_price->price = $request->business_class;
            //         }else{
            //             $flight_seat_price->price = 0;
            //         }
            //         $flight_seat_price->save();
            //     }
            // }
            $flightSchedule = FlightSchedule::find($request->flight_id);
            $airplaneFlight = $flightSchedule->airplaneFlight;
            $seats = $airplaneFlight->airplaneSeats;

            foreach ($seats as $seat) {
                $flight_seat_price = new FlightSeatPrice();
                $flight_seat_price->flight_id = $flightSchedule->id;
                $flight_seat_price->airplane_seat_id = $seat->id;

                if ($seat->travel_class_id == 1) {
                    $flight_seat_price->price = $request->first_class;
                } elseif ($seat->travel_class_id == 2) {
                    $flight_seat_price->price = $request->business_class;
                } elseif ($seat->travel_class_id == 3) {
                    $flight_seat_price->price = $request->premium_economy_class;
                } elseif ($seat->travel_class_id == 4) {
                    $flight_seat_price->price = $request->economy_class;
                } else {
                    $flight_seat_price->price = 0;
                }

                $flight_seat_price->save();
            }

        return redirect()->back()->with('success','The addition flight to the schedule was completed successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlightSeatPrice  $flightSeatPrice
     * @return \Illuminate\Http\Response
     */
    public function show(FlightSeatPrice $flightSeatPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlightSeatPrice  $flightSeatPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(FlightSeatPrice $flightSeatPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlightSeatPrice  $flightSeatPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlightSeatPrice $flightSeatPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlightSeatPrice  $flightSeatPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlightSeatPrice $flightSeatPrice)
    {
        //
    }
}
