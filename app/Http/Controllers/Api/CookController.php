<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CookController extends Controller
{
    public function getOrder(Request $request)
    {
        //$novaOrder = new Order;
        dd($request)
        return "OK";
    }
}
