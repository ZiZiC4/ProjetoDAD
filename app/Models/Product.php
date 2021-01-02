<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function orders(){
    	return $this->belongsToMany('App\Models\Order','order_items','product_id','order_id')->using('App\Models\OrderItem');
    }
}
