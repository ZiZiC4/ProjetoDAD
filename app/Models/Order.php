<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    //perguntar amanha
    public function products(){
    	return $this->belongsToMany('App\Models\Product','order_items','order_id','product_id')->using('App\Models\OrderItem');
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
