<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    protected $fillable=['first_name','last_name','phone','birthday','gender','passport','user_id','country_code'];
    public function booking(){
        return $this->hasOne('App\Models\Booking','id','Passenger_id');
    }
}
