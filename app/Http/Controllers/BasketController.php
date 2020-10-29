<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket (){
        $orderId = session('orderId');
        if(!is_null($orderId)){
            $order=Order::findOrFail($orderId);
            return view('basket', compact('order'));
        }else{
            session()->flash('warning', 'Basket is empty');
            return redirect()->route('index');
        }
    }

    public function basketPlace (){
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('index');
        }else{
            $order=Order::find($orderId);
        }
        return view('order', compact('order'));
    }

    public function basketConfirm(Request $request){
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('index');
        }else{
            $order=Order::find($orderId);
        }
        $success = $order->saveOrder($request->name, $request->phone);
        if($success){
            session()->flash('success', 'Order is accepted for processing');
        }else{
            session()->flash('warning', 'Error has been happen');
        }
        return redirect()->route('index');
    }

    public function basketAdd($productId){
        $orderId = session('orderId');
        if(is_null($orderId)){
            $order = Order::create();
            session(['orderId' => $order->id]);
        }else{
            $order=Order::find($orderId);
        }
        if($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id',$productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }else{
            $order->products()->attach($productId);
        }

        if(Auth::check()){
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($productId);

        session()->flash('success', 'Product '.$product->name.' added');
        return redirect()->route('basket');

    }

    public function basketRemove($productId){
        $orderId = session('orderId');
        if(is_null($orderId)){
            return redirect()->route('basket');
        }else{
            $order=Order::find($orderId);
        }

        if($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id',$productId)->first()->pivot;
            if($pivotRow->count < 2){
                $order->products()->detach($productId);
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);

        session()->flash('warning', 'Product '.$product->name.' removed');
        return redirect()->route('basket');
    }
}
