<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $PrimaryKey=['passenger_id','flight_id','airplane_id','seat_id'];
    protected $fillable=['passenger_id','flight_id','airplane_id','seat_id'];
}
