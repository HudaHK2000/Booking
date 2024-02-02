<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelClass extends Model
{
    use HasFactory;
    protected $fillable=['name','description'];

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
    public function airplaneSeats(){
        return $this->hasMany('App\Models\AirplaneSeat');
    }
}
