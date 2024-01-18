<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\TravelClass;
use App\Models\FlightSchedule;
use App\Models\FlightSeatPrice;
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
        // $this->middleware('auth');
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
    public function flightDetails($id)
    {
        $flightSchedule = FlightSchedule::find($id);
        $classes = FlightSeatPrice::where('flight_id', $flightSchedule->id)
        ->with('seat.travelClass')
        ->get()
        ->pluck('seat.travelClass')
        ->unique('id');
        
        for( $i = 0 ; $i < 4 ; $i++){
            $price[$i] = FlightSeatPrice::where('flight_id', $flightSchedule->id)
            ->whereHas('seat', function($query) use ($i) {
                $query->where('travel_class_id', $i+1 );
            })->first();
        }
        return view('frontend.booking',compact(['flightSchedule','classes','price']));
    }
    public function getAllFlight(Request $request) {
        $flights = FlightSchedule::with('airplaneFlight.airplaneSeats');
    
        // dd($request->date_return);

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
            $flights = $flights->where('departure_time', '>=', $request->departure.' 00:00:00');
            $flights = $flights->where('departure_time', '<=', $request->departure.' 23:59:59');
        }
        if($request->date_return){
            $flights = $flights->where('arrival_time', '>=' , $request->date_return.' 00:00:00');
            $flights = $flights->where('arrival_time', '<=' , $request->date_return.' 23:59:59');
        }
        if($request->adults + $request->childs){
            // dd($flights);

        //     $available_seats = FlightSeatPrice::where('flight_id', $flights->id)
        //         ->where('book', 0)->get();
        // dd($available_seats);
            $flights = $flights->whereHas('airplaneFlight', function($query) use ($request) {
                $query->where('number_of_seats', '>=', $request->adults + $request->childs );
            });
            // $seatsNeeded = $request->adults + $request->childs;

            // $flights = $flights->where(function($query) use ($seatsNeeded) {
            //     $query->whereHas('seat', function($subQuery) use ($seatsNeeded) {
            //         $subQuery->where('book', 0)
            //                  ->groupBy('flight_id')
            //                  ->havingRaw("COUNT(*) >= $seatsNeeded");
            //     });
            // });
        }
        
        // if($request->adults + $request->childs){
        //     $available_seats = FlightSeatPrice::where('flight_id', $request->flight_id)
        //     ->where('book', 0)
        //     ->whereHas('seat', function($query) use ($request) {
        //         $query->where('travel_class_id', $request->class);
        //     })->get();
        //     $flights = $flights->whereHas('airplaneFlight', function($query) use ($request) {
        //         $query->where('number_of_seats', '>=', $request->adults + $request->childs);
        //     });
        // }
        if($request->class){
            $flights = $flights->whereHas('airplaneFlight.airplaneSeats', function($query) use ($request) {
                $query->where('travel_class_id', $request->class);
            });
        }
    
        $flights = $flights->where('departure_time', '>', now()->toDateTimeString())->get();
        $flightSchedules = $flights;
        
        if ($flightSchedules->isEmpty()) {
            return redirect()->back()->with('Message', 'There are no flights compatible with the requests entered. Please choose another flight');
        } else {
            return view('frontend.flights', compact('flightSchedules'));
        }
    
    }
}
