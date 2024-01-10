<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directions = Direction::all();
        return view('dashboard.direction.index',compact('directions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $airports = Airport::all();
        return view('dashboard.direction.create',compact('airports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(),[
        //     'origin_airport_code' => ['required|'.
        //     Rule::unique('directions', 'origin_airport_code')->where(function ($query) use ($request) {
        //         return $query->where('destination_airport_code', $request->input('destination_airport_code'));
        //     })],
        //     'destination_airport_code' => ['required|different:origin_airport_code|'.
        //     Rule::unique('directions', 'destination_airport_code')->where(function ($query) use ($request) {
        //         return $query->where('origin_airport_code', $request->input('origin_airport_code'));
        //     })
        // ],
        // ]
        $validator = Validator::make($request->all(), [
            'origin_airport_code' => [
                'required',
                Rule::unique('directions', 'origin_airport_code')->where(function ($query) use ($request) {
                    return $query->where('destination_airport_code', $request->input('destination_airport_code'));
                })
            ],
            'destination_airport_code' => [
                'required',
                'different:origin_airport_code',
                Rule::unique('directions', 'destination_airport_code')->where(function ($query) use ($request) {
                    return $query->where('origin_airport_code', $request->input('origin_airport_code'));
                })]
            ],[
            'origin_airport_code.required'=> 'Please enter the departure airport',
            'destination_airport_code.required' => 'Please enter the arrival airport',
            'origin_airport_code.exists'=> 'Please select the airport name from the list. The airport you chose does not exist in the database',
            'destination_airport_code.exists' => 'Please select the airport name from the list. The airport you chose does not exist in the database',
            'destination_airport_code.different' => 'Please select a different arrival airport than the departure airport',
            'origin_airport_code.unique'=> 'This origin to destination airport combination already exists',
            'destination_airport_code.unique'=> 'This destination from arrival airport combination already exists',
        ])->validate();
        $direction = new Direction();
        $direction->origin_airport_code = $request->origin_airport_code ;
        $direction->destination_airport_code = $request->destination_airport_code ;
        $direction->save();
        return redirect()->back()->with('success','The addition process was completed successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function show(Direction $direction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $direction = Direction::find($id);
        $airports = Airport::all();
        return view('dashboard.direction.edit',compact(['direction','airports']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'origin_airport_code' => [
                'required',
                Rule::unique('directions', 'origin_airport_code')->where(function ($query) use ($request) {
                    return $query->where('destination_airport_code', $request->input('destination_airport_code'));
                })
            ],
            'destination_airport_code' => [
                'required',
                'different:origin_airport_code',
                Rule::unique('directions', 'destination_airport_code')->where(function ($query) use ($request) {
                    return $query->where('origin_airport_code', $request->input('origin_airport_code'));
                })]
            ],[
            'origin_airport_code.required'=> 'Please enter the departure airport',
            'destination_airport_code.required' => 'Please enter the arrival airport',
            'origin_airport_code.exists'=> 'Please select the airport name from the list. The airport you chose does not exist in the database',
            'destination_airport_code.exists' => 'Please select the airport name from the list. The airport you chose does not exist in the database',
            'destination_airport_code.different' => 'Please select a different arrival airport than the departure airport',
            'origin_airport_code.unique'=> 'This origin to destination airport combination already exists',
            'destination_airport_code.unique'=> 'This destination from arrival airport combination already exists',
        ])->validate();
        $direction = Direction::find($id);
        $direction->origin_airport_code = $request->origin_airport_code ;
        $direction->destination_airport_code = $request->destination_airport_code ;
        $direction->save();
        return redirect()->back()->with('success','The modification was completed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $direction = Direction::find($id);
        $direction->delete();
        return redirect()->back()->with('success','The deletion was completed successfully.');
    }
}
