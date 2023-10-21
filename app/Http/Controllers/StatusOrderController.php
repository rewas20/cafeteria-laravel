<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class StatusOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(3);
        return view('status-orders.index',['orders'=>$orders]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::find($id);
        return view('status-orders.edit',['order'=>$order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        if($request->all()['status']==="Done"){
            $this->destroy($id);
        }
        $order->update($request->all());
        return to_route('status-orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id);
        $order->delete();
        return to_route('status-orders.index');
    }
}
