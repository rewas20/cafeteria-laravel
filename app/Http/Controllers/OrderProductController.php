<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class OrderProductController extends Controller
{


    public function index(){

    }

    public function create(Request $request){
        $data = $request->all();
        $cart = session()->pull('cart');
        $user = session()->pull('user');
        if(isset($cart)&&isset($user)){

            $data['user_id']=$user->id;
            $order = Order::create($data);
            $orderProduct = [];
            foreach($cart as $key=>$value){
                $orderProduct['order_id'] = $order->id;
                $orderProduct['product_id'] = $key;
                $orderProduct['price'] = $value['price'];
                $orderProduct['count'] = $value['quantity'];

                OrderProduct::create($orderProduct);
            }

            return to_route('home')->with('success', 'product deleted successfully.');
        }
        return to_route('home')->with('error', 'product deleted successfully.');

    }
}
