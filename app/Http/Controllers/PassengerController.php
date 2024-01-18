<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Country;
use App\Models\User;
use App\Models\Booking;
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
        $profileBookings = Booking::where('passenger_id', \auth::user()->id)->get();
        $countNumSeat = $profileBookings->count();
        return view('frontend.profile',compact(['passenger','countries','profileBookings','countNumSeat']));
    }


    public function create()
    {
        $countries = Country::all();
        return view('frontend.passenger',compact('countries'));
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['required','numeric'],
            'birthday' => ['required'],
            'gender' => ['required'],
            'passport' => ['required'],
            'country_id' => ['required'],
            'user_id' => [ 'unique:passengers'],
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
        // return view('frontend.index');
        return redirect()->back()->with('Message', 'You have successfully registered as a traveler. Now you can book flights');

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
        if (!empty ($request->file('passport'))) {
            if(\File::exists(public_path('assets/images/passenger/').$passenger->passport)){
                \File::delete(public_path('assets/images/passenger/').$passenger->passport);
            }
            $imageName = uniqid() . $request->file('passport')->getClientOriginalName();

            $request->file('passport')->move(public_path('assets/images/passenger'), $imageName);
            $passenger->passport= $imageName;
        }
        $passenger->user_id = \Auth::user()->id ;
        $passenger->save();
        return redirect()->back()->with('Message', 'Your data has been successfully modified');

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
    public function usersIndex()
    {
        $users=User::all();
        return view('dashboard.user.index',compact('users'));
    }

    public function toggleAdminStatus($id)
    {
        $user = User::find($id);
        $user->is_admin = !$user->is_admin; 
        $user->save();

        return response()->json($user->is_admin ? 1 : 0);
    }
    public function usersDestroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'The deletion was completed successfully');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }
}
