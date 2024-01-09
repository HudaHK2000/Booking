<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;
    protected $fillable=['name','address','website','phone'];

    public function airplanes(){
        return $this->hasMany('App\Models\Airplane');
    }
}
