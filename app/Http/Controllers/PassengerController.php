<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ImageTrait;

class PassengerController extends Controller
{
    use ImageTrait ;
    public function index()
    {
        // return view('dashboard.passenger.index');
    }
    public function profile()
    {
        $countries = Country::all();
        $passenger = Passenger::where('user_id',\auth::user()->id)->first();
        return view('frontend.profile',compact(['passenger','countries']));
    }


    public function create()
    {
        $countries = Country::all();
        return view('frontend.passenger',compact('countries'));
        // $countries = Country::all();
        // return view('dashboard.passenger.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(\Auth::user()->id,$request);
        $validator = Validator::make($request->all(),[
            // 'first_name' => ['required'],
            // 'last_name' => ['required'],
            // 'phone' => ['required','numeric'],
            // 'birthday' => ['required'],
            // 'gender' => ['required'],
            // 'passport' => ['required'],
            // 'country_id' => ['required'],
            'user_id' => ['required', 'unique:passengers'],
        ],[
        ])->validate();
        
        $passenger = new Passenger();
        $passenger->first_name = $request->first_name ;
        $passenger->last_name = $request->last_name ;
        $passenger->phone = $request->phone ;
        $passenger->birthday = $request->birthday ;
        $passenger->gender = $request->gender ;
        $passenger->passport = $this->verifyAndUpload($request , 'passport' , 'assets/images/passenger/');

        $passenger->country_id = $request->country_id ;
        $passenger->user_id = \Auth::user()->id ;
        $passenger->save();
        return redirect()->back()->with('success','The addition process was completed successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        $validator = Validator::make($request->all(),[
            'phone' => ['numeric'],
        ],[
        ])->validate();
        $passenger->first_name = $request->first_name ;
        $passenger->last_name = $request->last_name ;
        $passenger->phone = $request->phone ;
        $passenger->birthday = $request->birthday ;
        $passenger->gender = $request->gender ;
        $passenger->country_id = $request->country_id ;
        if (!empty ($request->file('image'))) {
            if(\File::exists(public_path('assets/images/passenger/').$passenger->passport)){
                \File::delete(public_path('assets/images/passenger/').$passenger->passport);
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();

            $request->file('image')->move(public_path('assets/images/passenger'), $imageName);
            $passenger->passport= $imageName;
        }
        $passenger->user_id = \Auth::user()->id ;
        $passenger->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passenger $passenger)
    {
        if(\File::exists(public_path('assets/images/passenger/').$passenger->passport)){
            \File::delete(public_path('assets/images/passenger/').$passenger->passport);
        }
        $passenger->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    }
}
