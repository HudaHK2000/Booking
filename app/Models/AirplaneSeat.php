<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirplaneSeat extends Model
{
    use HasFactory;
    // protected $PrimaryKey = ['seat_id', 'airplane_id'];
    protected $fillable=['seat_id','travel_class_id','airplane_id'];

    public function airplane(){
        return $this->belongsTo('App\Models\Airplane','airplane_id','id');
    }

    public function travelClass(){
        return $this->belongsTo('App\Models\TravelClass','travel_class_id','id');
    }
    public function seatsPrice(){
        return $this->hasOne('App\Models\FlightSeatPrice','id','airplane_seat_id');
    }
}
