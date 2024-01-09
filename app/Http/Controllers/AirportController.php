<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirportController extends Controller
{
    public function index(){
        // جلب جميع objet في جدول ال menu 
        $airports = Airport::all();
        $countries = Country::all();
        return view('dashboard.airport.index',compact('countries','airports'));
    }
    public function create()
    {
        $countries = Country::all();
        $cities = City::all();
        return view('dashboard.airport.create',compact(['countries','cities']));
    }
    public function getCities($countryId){
        $cities = City::where('country_id', $countryId)->get();
        return response()->json($cities);
    }
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:airports,name'],
            'airport_code' => ['required','string','unique:airports,airport_code','regex:/^[A-Za-z]{3}$/'],
            'city_id' => ['required','exists:cities,id'],
            'country_id' => ['required','exists:countries,id'],
        ],[
            'name.required'=> 'Please enter the airport name',
            'name.unique'=> 'The airport name has already been taken',
            'airport_code.required' => 'Please enter the airport code',
            'airport_code.regex' => 'Please the airport code should be exactly 3 letters',
            'airport_code.string' => 'Please enter the airport code in characters only, for example ALP',
            'airport_code.unique' => 'The airport code has already been taken',
            'city_id.required'=> 'Please choose the city name',
            'city_id.exists' => 'Please choose the city name from the list',
            'country_id.required' => 'Please choose the country',
            'country_id.exists' => 'Please choose the country from the list',
        ])->validate();

            // dd($request->city_id );
        $airport = new Airport();
        $airport->name = $request->name ;
        $airport->airport_code = $request->airport_code ;
        $airport->city_id = $request->city_id ;
        $airport->save();
        return redirect()->back()->with('success','The addition process was completed successfully.');
    }

    public function show(Airport $airport)
    {
        //
    }

    public function edit($id)
    {
        $airport = Airport::find($id);
        $countries = Country::all();
        $cities = City::all();
        return view('dashboard.airport.edit',compact(['airport','countries','cities']));
    }

    public function update($id,Request $request)
    {
        $validators = Validator::make($request->all(),[
            'name' => ['required'],
            'airport_code' => ['required','string','regex:/^[A-Za-z]{3}$/',],
            'city_id' => ['required','exists:cities,id'],
            'country_id' => ['required','exists:countries,id'],
        ],[
            'name.required'=> 'Please enter the airport name',
            'airport_code.required' => 'Please enter the airport code',
            'airport_code.regex' => 'Please the airport code should be exactly 3 letters',
            'airport_code.string' => 'Please enter the airport code in characters only, for example ALP',
            'city_id.required'=> 'Please choose the city name',
            'city_id.exists' => 'Please choose the city name from the list',
            'country_id.required' => 'Please choose the country',
            'country_id.exists' => 'Please choose the country from the list',
        ])->validate();
        $airport = Airport::find($id);
        $airport->name = $request->name ;
        $airport->airport_code = $request->airport_code ;
        $airport->city_id = $request->city_id ;
        $airport->save();
        return redirect()->back()->with('success','The modification was completed successfully.');
    }

    public function destroy($id)
    {
        $airport = Airport::find($id);
        $airport->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    
    }
}
