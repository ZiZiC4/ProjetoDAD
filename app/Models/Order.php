<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //perguntar amanha
    public function orderItems(){
    	return $this->hasMany('App\Models\OrderItem','order_id','id');
    }

    public function userPrepared(){
        return $this->belongsTo('App\Models\User','prepared_by','id');
    }

    public function userDelivered(){
        return $this->belongsTo('App\Models\User','delivered_by','id');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
}
