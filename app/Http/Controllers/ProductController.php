<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Validator as ValidationValidator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id','DESC')->paginate(3);
        return view('Products.index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // return to_route('products.index',['product']);
        $validator = Validator::make($request->all(), 
        [
            'name' =>'required',
            'price' =>'required|numeric',
            'image' => 'required|image:gif,jpg,bmp,png'
        ]);
        if($validator->fails()){
            return redirect()->route('products.create')->withErrors($validator)->withInput();
        }
        else{
            $product = new Product();
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->status = $data['status'];
            $product->category_id = 1;
            //image move ......
            $ext = $data['image']->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $data['image']->move(public_path().'/uploads/products',$newFileName);
            $product->image = $newFileName;
            $product->save();
            //end of move
            return redirect()->route('products.index')->with('success','Employee added successfully.');   
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.index',['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), 
        [
            'name' =>'required',
            'price' =>'required|numeric',
            'image' => 'required|image:gif,jpg,bmp,png'
        ]);
        if($validator->fails()){
            return redirect()->route('products.edit')->withErrors($validator)->withInput();
        }
        else{            
            $product->fill($request->post())->save();
            $oldImage = $product->image;
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->image->move(public_path().'/uploads/products/',$newFileName); 
            $product->image = $newFileName;
            $product->save();
            File::delete(public_path().'/uploads/products/'.$oldImage);
        }
        return redirect()->route('products.index')->with('success','product updated successfully.');   
     }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
        File::delete(public_path().'/uploads/products/'.$product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success','product deleted successfully.');
    }

}
