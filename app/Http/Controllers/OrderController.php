<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $orders = Order::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(3);

        $total = $this->sumTotal($orders);
        return view('orders.index', ['orders' => $orders, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
/*     public function store(Request $request)
    {
       
    } */

    /**
     * Display the specified resource.
     */
    // public function show(Order $order)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Order $order)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Order $order)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        return to_route('orders.index');
    }

    /**
     * Filter the user orders by date.
     */
    public function filter(Request $request)
    {

        $date_from = $request->date_from ? $request->date_from : '2020-01-1 00:00';
        $date_to = $request->date_to ? $request->date_to : now()->addDays(1)->format('Y-m-d');
        // dd($date_from);

        $orders = Order::where('user_id', Auth::id())
        ->whereBetween('created_at', [$date_from,$date_to])
        ->orderByDesc('created_at')
            ->paginate(3);

        $total = $this->sumTotal($orders);
        return view('orders.index', ['orders' => $orders, 'total' => $total]);
    }

    public function sumTotal($orders)
    {

        $total = 0;
        foreach ($orders as $order) {
            foreach($order->products as $product){
                $total += $product->pivot->count * $product->price;
            }
        }

        return $total;
    }
}
