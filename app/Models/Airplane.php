<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airplane extends Model
{
    use HasFactory;
    protected $fillable=['model','airline_id','number_of_seats'];

    public function airline(){
        return $this->belongsTo('App\Models\Airline','airline_id','id');
    }

    public function airplaneSeats(){
        return $this->hasMany('App\Models\AirplaneSeat');
    }
    public static function boot(){
        parent::boot();
        static::saving(function(){
            \Cache::flush();
        });
        static::updating(function(){
            \Cache::flush();
        });
        static::deleting(function(){
            \Cache::flush();
        });
    }
}
