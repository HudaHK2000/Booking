<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use App\Models\AirplaneSeat;
use App\Models\Airline;
use App\Models\TravelClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirplaneController extends Controller
{
    public function index()
    {
        $airplanes = Airplane::all();
        return view('dashboard.airplane.index',compact('airplanes'));
    }

    public function create()
    {
        $airlines = Airline::all();
        return view('dashboard.airplane.create',compact('airlines'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'model' => ['required'],
            'airline_id' => ['required','exists:airlines,id'],
            'number_of_seats' => ['required','numeric'],
        ],[
            'model.required'=> 'Please enter the airplane model',
            'airline_id.required' => 'Please enter the airline of the airplane',
            'airline_id.exists'=> 'Please choose the airline from the list',
            'number_of_seats.required' => 'Please enter the number of seat for airplane',
            'number_of_seats.numeric' => 'Please enter the number of seat as numbers only',
        ])->validate();
        $airplanes = new Airplane();
        $airplanes->model = $request->model ;
        $airplanes->airline_id = $request->airline_id ;
        $airplanes->number_of_seats = $request->number_of_seats ;
        $airplanes->save();

        $travel_class = TravelClass::where('name','Economy Class')->first();
        // dd($travel_class->id);
        if(isset($travel_class)){
            for( $i = 1 ; $i <= $request->number_of_seats ; $i++){
                $airplane_seat = new AirplaneSeat();
                $airplane_seat->seat_id = $i;
                $airplane_seat->travel_class_id = $travel_class->id;
                $airplane_seat->airplane_id = $airplanes->id;
                $airplane_seat->save();
            }
        }
        return redirect()->back()->with('success','The addition process was completed successfully.');
    }

    public function show( $id)
    {
        $travelClasses = TravelClass::all();
        $airplaneSeats = AirplaneSeat::where('airplane_id', $id)->orderBy('airplane_id', 'Asc')->get();
        return view('dashboard.airplane.show',compact(['airplaneSeats','travelClasses']));
    }

    public function edit($id)
    {
        $airplane = Airplane::find($id);
        $airlines = Airline::all();
        return view('dashboard.airplane.edit',compact(['airplane','airlines']));
    }

    public function update($id,Request $request)
    {
        $validator = Validator::make($request->all(),[
            'model' => ['required'],
            'airline_id' => ['required','exists:airlines,id'],
            'number_of_seats' => ['required','numeric'],
        ],[
            'model.required'=> 'Please enter the airplane model',
            'airline_id.required' => 'Please enter the airline of the airplane',
            'airline_id.exists'=> 'Please choose the airline from the list',
            'number_of_seats.required' => 'Please enter the number of seat for airplane',
            'number_of_seats.numeric' => 'Please enter the number of seat as numbers only',
        ])->validate();

        $airplane = Airplane::find($id);
        $airplane->model = $request->model;
        $airplane->airline_id = $request->airline_id;
        if ($airplane->number_of_seats > $request->number_of_seats) {
            $airplaneSeat = $airplane->airplaneSeats;
            for ($i = $request->number_of_seats + 1; $i <= $airplane->number_of_seats; $i++) {
                $airplane_seat = AirplaneSeat::where('seat_id', $i)->where('airplane_id', $airplane->id)->delete();
            }
        }
        elseif($airplane->number_of_seats < $request->number_of_seats){
            $travel_class = TravelClass::where('name','Economy Class')->first();
            if(isset($travel_class)){
                for ($i = $airplane->number_of_seats + 1; $i <= $request->number_of_seats; $i++) {
                    $airplane_seat = new AirplaneSeat();
                    $airplane_seat->seat_id = $i;
                    $airplane_seat->travel_class_id = $travel_class->id;
                    $airplane_seat->airplane_id = $airplane->id;
                    $airplane_seat->save();
                }
            }
            
        }
        $airplane->number_of_seats = $request->number_of_seats;
        $airplane->save();
        return redirect()->back()->with('success', 'The modification was completed successfully.');
    }
    public function updateAirplaneSeat($id,Request $request)
    {
        $airplane_seat = AirplaneSeat::find($id);
        $airplane_seat->travel_class_id = $request->travel_class_id;
        $airplane_seat->save();

        // $airplane_seat = AirplaneSeat::where('seat_id', $seat_id)->where('airplane_id', $airplane_id)->updateOrInsert(
        //     ['travel_class_id' => $request->travel_class_id]
        // );
        // $airplane_seat = AirplaneSeat::where('seat_id', $seat_id)->where('airplane_id', $airplane_id)->first();
        // $airplane_seat->travel_class_id = $request->travel_class_id;
        // dd($seat_id , $airplane_id ,$request->travel_class_id ,  $airplane_seat->travel_class_id);
        // $airplane_seat->save();
        // $airplane_seat::updateOrInsert(
        //     ['travel_class_id' => $request->travel_class_id]
        // );
        // $airplane_seat->update(['travel_class_id' => $request->travel_class_id]);
        return redirect()->back()->with('success', 'The modification was completed successfully.');
    }

    public function destroy($id)
    {
        $airplane = Airplane::find($id);
        $airplane->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    
    }
}
