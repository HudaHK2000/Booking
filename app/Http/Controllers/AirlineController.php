<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirlineController extends Controller
{
    public function index(){
        $airlines = airline::all();
        return view('dashboard.airline.index',compact('airlines'));
    }
    public function create()
    {
        return view('dashboard.airline.create');
    }
    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'address' => ['required'],
            'website' => ['required'],
            'phone' => ['required','numeric'],
        ],[
            'name.required'=> 'Please enter the airline name',
            'address.required' => 'Please enter the address of airline',
            'website.required'=> 'Please enter the website of airline',
            'phone.required' => 'Please enter the phone of airline',
            'phone.numeric' => 'Please enter phone as numbers only',
        ])->validate();
        $airline = new Airline();
        $airline->name = $request->name ;
        $airline->address = $request->address ;
        $airline->website = $request->website ;
        $airline->phone = $request->phone ;
        $airline->save();
        return redirect()->back()->with('success','The addition process was completed successfully.');
    }
    public function show(Airline $airline)
    {
        //
    }
    public function edit($id)
    {
        $airline = Airline::find($id);
        return view('dashboard.airline.edit',compact('airline'));
    }

    public function update($id,Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'address' => ['required'],
            'website' => ['required'],
            'phone' => ['required','numeric'],
        ],[
            'name.required'=> 'Please enter the airline name',
            'address.required' => 'Please enter the address of airline',
            'website.required'=> 'Please enter the website of airline',
            'phone.required' => 'Please enter the phone of airline',
            'phone.numeric' => 'Please enter phone as numbers only',
        ])->validate();
        $airline = airline::find($id);
        $airline->name = $request->name ;
        $airline->address = $request->address ;
        $airline->website = $request->website ;
        $airline->phone = $request->phone ;
        $airline->save();
        return redirect()->back()->with('success','The modification was completed successfully.');
    }

    public function destroy($id)
    {
        $airline = Airline::find($id);
        $airline->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    
    }
}
