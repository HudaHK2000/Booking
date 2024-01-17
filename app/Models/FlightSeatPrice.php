<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightSeatPrice extends Model
{
    use HasFactory;
    // protected $PrimaryKey=['flight_id','airplane_id','seat_id'];
    protected $fillable=['flight_id','airplane_seat_id','price','book'];

    // public function flight(){
    //     return $this->belongsTo('App\Models\FlightSchedule','flight_id','id');
    // }
    public function seat(){
        return $this->belongsTo('App\Models\AirplaneSeat','airplane_seat_id','id');
    }
    public function flightSchedule(){
        return $this->belongsTo('App\Models\FlightSchedule','flight_id','id');
    }
}
