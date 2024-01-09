<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable=['country_id','name'];
    public function country(){
        return $this->belongsTo('App\Models\Country','country_id','id');
    }
    public function airport(){
        return $this->hasOne('App\Models\Airport');
    }
}
