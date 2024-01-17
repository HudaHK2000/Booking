<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    // protected $PrimaryKey=['passenger_id','flight_seat_prices_id'];
    protected $fillable=['Passenger_id','flight_seat_prices_id'];
    public function passenger(){
        return $this->belongsTo('App\Models\Passenger','Passenger_id','id');
    }
    public function flightSeat(){
        return $this->belongsTo('App\Models\FlightSeatPrice','flight_seat_prices_id','id');
    }
}
