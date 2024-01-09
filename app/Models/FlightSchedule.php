<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightSchedule extends Model
{
    use HasFactory;
    protected $fillable=['direction_id','airplane_id','flight_status_id','departure_time','arrival_time'];
    
    public function direction(){
        return $this->belongsTo('App\Models\Direction','direction_id','id');
    }
    public function flightStatu(){
        return $this->belongsTo('App\Models\FlightStatu','flight_status_id','id');
    }
    public function airplaneFlight(){
        return $this->belongsTo('App\Models\Airplane','airplane_id','id');
    }
}
