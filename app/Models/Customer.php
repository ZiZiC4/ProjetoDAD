<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\User;

class Customer extends User
{
    use HasFactory;

    public function users(){
        return $this->belongsTo('App\Models\User','id','id');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order','customer_id','id');
    }

}
