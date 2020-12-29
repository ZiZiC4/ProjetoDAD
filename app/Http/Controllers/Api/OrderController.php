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
        
        $novaOrder = new Order;
        $novaOrder->customer_id = $request->customer_id;
        $novaOrder->notes = $request->notes;
        $cook = User::where('type','EC')->orderBy('available_at','asc')->whereNotNull("available_at")->first();
        if($cook != null){
            $novaOrder->status = "P";
            $novaOrder->prepared_by = $cook->id;
            $cook->available_at = null;
            $cook->save();
        }else{
            $novaOrder->status = "H";
            $novaOrder->prepared_by = null;
        }

        $novaOrder->total_price = 0;
        $ldate = date('Y-m-d');
        $tdate = date('Y-m-d H:i:s');
        $novaOrder->date = $ldate;
        $novaOrder->opened_at = $tdate;
        $novaOrder->current_status_at = $tdate;
        

        
        $novaOrder->save();


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
            $order = Order::where('prepared_by',$user->id)->where('status','=','P')->orderBy('opened_at','asc')->first();
            if(!$order){
                $order = Order::where('prepared_by',null)->where('status','=','H')->orderBy('opened_at','asc')->first();
                if($order){
                    $order->prepared_by = $user->id;
                    $order->status = "P";
                    $order->save();
                }else{
                    return null;
                }
            }

            
            if($order){
                $client = User::where('id',$order->customer_id)->get(['id','name']);
                $items = OrderItem::with('product')->where('order_id',$order->id)->get(['product_id','quantity']);
                return response()->json(['items' => $items,'order'=> $order,'client' => $client], 200);
            }else{
                return null;
            }
            
            
        }
        //$novaOrder = new Order;
        //dd($request)
        return null;
    }
}
