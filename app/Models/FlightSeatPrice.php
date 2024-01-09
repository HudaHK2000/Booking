<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightSeatPrice extends Model
{
    use HasFactory;
    protected $PrimaryKey=['flight_id','airplane_id','seat_id'];
    protected $fillable=['flight_id','airplane_id','seat_id','price'];
}
