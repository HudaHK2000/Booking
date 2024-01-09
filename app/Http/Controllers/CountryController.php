<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index(){
        $countries = Country::orderBy('name', 'ASC')->get();
        return view('dashboard.country.index',compact('countries'));
    }
    public function create()
    {
        return view('dashboard.country.create');
    }

    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:Countries'],
            'country_code' => ['required','numeric'],
        ],[
            'name.unique'=>'اسم البلد موجود مسبقا',
            'name.required'=> 'يرجى إدخال اسم البلد',
            'country_code.required' => 'يرجى إدخال رمز البلد',
            'country_code.numeric' => 'يرجى إدخال رمز البلد بالأرقام فقط',
        ])->validate();
        $country = new Country();
        $country->name = $request->name ;
        $country->country_code = $request->country_code ;
        $country->save();
        return redirect()->back()->with('success','The addition process was completed successfully.');
    }

    public function show(Country $country)
    {
        //
    }

    
    public function edit($id)
    {
        // $country = Country::where('country_code',$country_code)->first();
        $country = Country::find($id);
        return view('dashboard.country.edit',compact('country'));
    }

    public function update($id,Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'country_code' => ['required','numeric'],
        ],[
            'name.required'=> 'يرجى إدخال اسم البلد',
            'country_code.required' => 'يرجى إدخال رمز البلد',
            'country_code.numeric' => 'يرجى إدخال رمز البلد بالأرقام فقط',
        ])->validate();
        // $country = Country::where('country_code',$country_code)->first();
        // $country->update(['name' => $request->name]);
        $country = Country::find($id);
        $country->country_code = $request->country_code ;
        $country->name = $request->name ;
        $country->save();
        return redirect()->back()->with('success','The modification was completed successfully.');
    }

    public function destroy($id)
    {
        $country = country::find($id);
        $country->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    
    }
}
