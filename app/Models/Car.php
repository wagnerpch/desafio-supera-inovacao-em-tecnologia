<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
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

    public function maintenance(){
        return $this->belongsTo('App\Models\Maintenance');
    }

    public function maintenances(){
        return $this->belongsToMany('App\Models\Maintenance');
    }

}
