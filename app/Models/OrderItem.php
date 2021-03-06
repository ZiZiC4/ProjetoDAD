<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    //use SoftDeletes;
    public $timestamps = false;
    
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
