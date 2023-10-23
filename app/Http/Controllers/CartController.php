<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productId = $id;
        $product = Product::find($productId);
   
            $cart= session()->pull('cart');
            if(isset($cart[$productId])){
                $cart[$productId]['quantity']++;
            }
            else{
                $cart[$productId] =
                [
                    'name'=> $product->name,
                    'quantity'=> 1,
                    'price'=> $product->price,
                    'image' => $product->image,
                ];
            }
            session()->put('cart',$cart);
    // dd($cart);
        return to_route("home");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

       $cart = Session()->pull('cart');
       if(isset($cart))
       unset($cart[$id]);
       session()->put('cart',$cart);
       return to_route('home');
    }
    public function increment(string $id){
       $cart = Session()->pull('cart');
       if(isset($cart)){
        $cart[$id]['quantity']++;
       }
       session()->put('cart',$cart);
       return to_route('home');
    }
    
    public function decrement(string $id){
        $cart = Session()->pull('cart');
        if(isset($cart) && $cart[$id]['quantity'] > 1){
            $cart[$id]['quantity']--;
           }
           session()->put('cart',$cart);
           return to_route('home');
    }
}
