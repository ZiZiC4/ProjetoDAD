<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;

class OrderController extends Controller
{
    
    public function createOrder(Request $request)
    {
        //falta depois alterar o estado do cook para no available
        $novaOrder = new Order;
        $novaOrder->status = "H";
        $novaOrder->customer_id = $request->customer_id;
        $novaOrder->notes = $request->notes;
        $cook = User::where('type','EC')->orderBy('available_at','asc')->whereNotNull("available_at")->first();
        if($cook != null){
            $novaOrder->prepared_by = $cook->id;
            $cook->available_at = null;
            $cook->save();
        }else{
            $novaOrder->prepared_by = null;
        }
        //$cook = User::where('type','EC')->orderBy('available_at','asc')->whereNotNull("available_at")->first();
        
        //$novaOrder->delivered_by = null;
        $novaOrder->total_price = 0;
        $ldate = date('Y-m-d');
        $tdate = date('Y-m-d H:i:s');
        $novaOrder->date = $ldate;
        $novaOrder->opened_at = $tdate;
        $novaOrder->current_status_at = $tdate;
        

        
        $novaOrder->save();

        //$request->products[0]
        //$id = $novaOrder->id;
        /*
        foreach($request->products as $prod){
            $calcSubTotal = $request->products[$prod]->quant * $request->products[$idx]->prod->price;
            $novaOrder->products()->product_id = $request->products[$idx]->prod->id;
            $novaOrder->products()->quantity = $request->products[$idx]->quant;
            $novaOrder->products()->unit_price = $request->products[$idx]->prod->price;
            $novaOrder->products()->sub_total = $calcSubTotal;
        }*/
        /*
        $calcSubTotal = $request->products[0]->quant * $request->products[0]->prod->price;
        $novaOrder->products()->product_id = $request->products[0]->prod->id;
        $novaOrder->products()->quantity = $request->products[0]->quant;
        $novaOrder->products()->unit_price = $request->products[0]->prod->price;
        $novaOrder->products()->sub_total = $calcSubTotal;*/

        //$nome = $request->name;
        foreach($request->products as $prod){
            $calcSubTotal = $prod['quant'] * $prod['prod']['price'];
            $novoOrderItem = new OrderItem;
            $novoOrderItem->order()->associate($novaOrder);
            $novoOrderItem->product_id = $prod['prod']['id'];
            $novoOrderItem->quantity = $prod['quant'];
            $novoOrderItem->unit_price =$prod['prod']['price'] ;
            $novoOrderItem->sub_total_price = $calcSubTotal;
            $novoOrderItem->save();    
        }

        return $novaOrder;
    }


    public function getOrder(Request $request)
    {

        $user = $request->user();
        if($user->type==="EC"){
            $order = Order::where('prepared_by',$user->id)->orderBy('opened_at','asc')->first();
            return $order;
        }
        //$novaOrder = new Order;
        //dd($request);
        //return "OK";
    }
}
