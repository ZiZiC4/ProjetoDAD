<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Customer extends Model
{

    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'address', 'phone', 'nif'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order','customer_id','id');
    }

}
