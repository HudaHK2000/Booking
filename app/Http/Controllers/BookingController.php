<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Country;
use App\Models\TravelClass;
use App\Models\FlightSeatPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['passenger'])->get();
        return view('dashboard.booking.index',compact('bookings'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'hello passenger'; 
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
            'class' => ['required'],
        ],[
        ])->validate();
        
        $number_of_seats_required = $request->childs+$request->adults ;
        $available_seats = FlightSeatPrice::where('flight_id', $request->flight_id)
        ->where('book', 0)
        ->whereHas('seat', function($query) use ($request) {
            $query->where('travel_class_id', $request->class);
        })->get();
        $number_of_seats_available  = $available_seats->count() ;
        if($number_of_seats_available >= $number_of_seats_required ){
            for( $i=0 ; $i < $number_of_seats_required ; $i++ ){
                $book = new Booking();
                $passenger_id = \Auth::user()->passenger->id;
                $book->Passenger_id = $passenger_id ;
                
                // استخدام first() بدلاً من get() للحصول على سجل واحد فقط
                $available_seat = FlightSeatPrice::where('flight_id', $request->flight_id)
                    ->where('book', 0)
                    ->whereHas('seat', function($query) use ($request) {
                        $query->where('travel_class_id', $request->class);
                    })->first();
        
                // التأكد من أن تم العثور على مقعد قبل تغيير قيمة الحقل "book"
                if($available_seat){
                    $book->flight_seat_prices_id = $available_seat->id ;
                    $available_seat->book = 1 ;
                    $available_seat->save(); // حفظ التغييرات
                    $book->save();
                }
            }
            return redirect('profile')->with('Message', 'Your reservation has been completed successfully');
        }else{
            return redirect()->with('Message', 'There are not enough seats on the plane');
        }
        
    }
    public function calculateTotalPrice(Request $request){
        $adults = $request->input('adults');
        $childs = $request->input('childs');
        $selectedClass = $request->input('class');
        $flightId = $request->input('flightId');
        // dd($selectedClass,$childs , $adults);
        // قم بحساب السعر بناءً على عدد البالغين والأطفال والفئة المختارة
        $totalPrice = $this->calculatePrice($adults, $childs, $selectedClass, $flightId);
        // dd($total_price);
        return response()->json(['totalPrice' => $totalPrice]);
    }
    private function calculatePrice($adults, $childs, $selectedClass, $flightId){
        $count = $adults + $childs;
        $total_price = FlightSeatPrice::where('flight_id', $flightId)
            ->whereHas('seat', function($query) use ($selectedClass) {
                $query->where('travel_class_id', $selectedClass);
            })->first();
        if($total_price){
            $total_price = $total_price->price * $count;
            return $total_price;
        }
        return 0; // إذا لم يتم العثور على سعر
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
