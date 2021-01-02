<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    public function profile(Request $request){
        $customer = Customer::where('id',$request->id);
        return response()->json(['customerInfo'=>$customer],200);
    }
}
