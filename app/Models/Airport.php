<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    // protected $PrimaryKey="airport_code";
    protected $fillable=['airport_code','name','city_id'];

    public function city(){
        return $this->belongsTo('App\Models\City','city_id','id');
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
