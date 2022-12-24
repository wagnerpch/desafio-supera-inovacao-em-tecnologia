<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    
    protected $dates = ['date'];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function car(){
        return $this->belongsTo('App\Models\Car');
    }
    
    public function cars(){
        return $this->belongsToMany('App\Models\Car');
    }
    
}