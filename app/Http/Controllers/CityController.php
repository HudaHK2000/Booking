<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('dashboard.city.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $countries = Country::all();
        return view('dashboard.city.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:cities'],
            'country_id' => ['required','exists:countries,name'],
        ],[
            'name.unique'=> 'اسم المدينة موجود مسبقا',
            'name.required'=> 'يرجى إدخال اسم المدينة',
            'country_id.required' => 'يرجى اختيار البلد',
            'country_id.exists' => 'يرجى اختيار البلد من القائمة',
        ])->validate();

        $country = Country::where("name",$request->country_id)->first();
        $city = new City();
        $city->name = $request->name ;
        $city->country_id = $country->id ;
        $city->save();
        return redirect()->back()->with('success','The addition process was completed successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $countries = Country::all();
        return view('dashboard.city.edit',compact(['city','countries']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'country_id' => ['required','exists:countries,name'],
        ],[
            'name.required'=> 'يرجى إدخال اسم المدينة',
            'country_id.required' => 'يرجى اختيار البلد',
            'country_id.exists' => 'يرجى اختيار البلد من القائمة',
        ])->validate();

        $country = Country::where("name",$request->country_id)->first();
        $city = City::find($id);
        $city->name = $request->name ;
        $city->country_id = $country->id ;
        $city->save();
        return redirect()->back()->with('success','The modification was completed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    }
}
