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
            $user->available_at = null;
            if(!$order){
                $order = Order::where('prepared_by',null)->where('status','=','H')->orderBy('opened_at','asc')->first();
                if($order){
                    $order->prepared_by = $user->id;
                    $user->available_at = null;
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
        return null;
    }

    public function updateOrder(Request $request, Order $order){
        
        if($request->type=="EC"){
            $cook = User::find($order->prepared_by);
            $order->status = "R";
            $tdate = date('Y-m-d H:i:s');
            $cook->available_at = $tdate;
            $order->current_status_at=$tdate;
            $order->save();
            $cook->save();

            return $order;
        }else if($request->type=="ED"){
            $tdate = date('Y-m-d H:i:s');
            $delMan = User::find($request->id);
            $delMan->available_at = null;
            
            $order->delivered_by = $delMan->id;
            $order->current_status_at = $tdate;
            $order->status = "T";
            $user = User::with('customer')->find($order->customer_id);
            $items = OrderItem::with('product')->where('order_id',$order->id)->get(['product_id','quantity']);
            $delMan->save();
            $order->save();
            return response()->json(['items' => $items,'userInfo'=>$user],200);
        }
    }


    public function getReadyOrders(Request $request){

        $orders = Order::where('status','R')->get();

        $nomes = array();
        foreach($orders as $order){
             $user=User::find($order->customer_id);
             array_push($nomes,$user->name);
            //$teste=$order->customer_id;
        }

        return response()->json(['orders'=>$orders,'clientInfo'=>$nomes],200);

    }

    public function deliverOrder(Request $request, Order $order){

        $order->status = "D";
        $tdate = date('Y-m-d H:i:s');
        $order->current_status_at=$tdate;
        $order->closed_at=$tdate;
        $order->save();
        $delMan = User::find($request->id);
        $delMan->available_at = $tdate;
        $delMan->save();

        return $delMan->available_at;
    }



}
