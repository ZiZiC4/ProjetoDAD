<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function profile(Request $request){
        $customer = Customer::find($request->id);
        return response()->json(['customerInfo'=>$customer],200);
    }
}
