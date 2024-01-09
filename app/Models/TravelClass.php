<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelClass extends Model
{
    use HasFactory;
    protected $fillable=['name','description'];

    public function airplaneSeats(){
        return $this->hasMany('App\Models\AirplaneSeat');
    }
}
