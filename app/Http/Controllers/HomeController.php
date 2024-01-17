<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\TravelClass;
use App\Models\FlightSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countries = Country::all();
        $classes = TravelClass::all();
        $flightSchedules = FlightSchedule::where('departure_time', '>', now()->toDateTimeString())->get();
        return view('frontend.index',compact(['countries','classes','flightSchedules']));
    }
    static public function calculateTimeDifference($departure_time,$arrival_time)
    {
        $departureTime = Carbon::parse($departure_time);
        $arrivalTime = Carbon::parse($arrival_time);
        $timeDiff = $arrivalTime->diff($departureTime);
        $timeDiff = $timeDiff->format('%H Hour & %I mints');

        return $timeDiff;
    }
    public function getAllFlight(Request $request) {
        $flights = FlightSchedule::with('airplaneFlight.airplaneSeats');
    
        if($request->from){
            $flights = $flights->whereHas('direction.originAirport.city.country', function($query) use ($request) {
                $query->where('id', $request->from);
            });
        }
        if($request->to){
            $flights = $flights->whereHas('direction.destinationAirport.city.country', function($query) use ($request) {
                $query->where('id', $request->to);
            });
        }
        if($request->departure){
            $flights = $flights->where('departure_time', '=', $request->departure);
        }
        if($request->return){
            $flights = $flights->where('arrival_time', '=', $request->return);
        }
        if($request->adults + $request->childs){
            $flights = $flights->whereHas('airplaneFlight', function($query) use ($request) {
                $query->where('number_of_seats', '>=', $request->adults + $request->childs);
            });
        }
        if($request->class){
            $flights = $flights->whereHas('airplaneFlight.airplaneSeats', function($query) use ($request) {
                $query->where('travel_class_id', $request->class);
            });
        }
    
        $flights = $flights->where('departure_time', '>', now()->toDateTimeString())->get();
        $flightSchedules=$flights;
        
        return view('frontend.flights',compact('flightSchedules'));
    }

}
