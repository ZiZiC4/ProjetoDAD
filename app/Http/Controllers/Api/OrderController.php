<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    
    public function createOrder(Request $request)
    {
        //$novaOrder = new Order;
        dd($request)
        return "OK";
    }
}
