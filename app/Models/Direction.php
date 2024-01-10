<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;
    // protected $PrimaryKey=['origin_airport_code','destination_airport_code'];
    protected $fillable=['origin_airport_code','destination_airport_code'];

    public function originAirport(){
        return $this->belongsTo('App\Models\Airport','origin_airport_code','id');
    }
    public function destinationAirport(){
        return $this->belongsTo('App\Models\Airport','destination_airport_code','id');
    }
}
