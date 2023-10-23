<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id','DESC')->paginate(5);
        return view('products.index', ['products' => $products]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // return to_route('products.index',['product']);
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required|numeric',
                'image' => 'required|image:gif,jpg,bmp,png',
                'category' => 'required',
            ]
        );
        if ($validator->fails()) {
            return redirect()->route('products.create')->withErrors($validator)->withInput();
        } else {
            $product = new Product();
            $product->name = $data['name'];
            $product->price = $data['price'];
            $product->status = $data['status'];
            $product->category_id = $data['category'];
            //image move ......
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
            $product->save();
            //end of move

            return redirect()->route('products.index')->with('success','Product is added successfully.');   

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.index', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::withTrashed()->get();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required|numeric',
                'image' => 'image:gif,jpg,bmp,png',
            ]
        );
        if ($validator->fails()) {
            return to_route('products.edit',$product)->withErrors($validator);
        } else {
            $product->fill($request->post())->save();
            if ($request->hasFile('image')) {
                if($product->image&&Storage::exists('public/'.$product->image)){
                    unlink('storage/'.$product->image);
                }
              
                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
               
                $product->save();
            }
        }
        return to_route('products.index')->with('success', 'product updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->image&&Storage::exists('public/'.$product->image)){
            unlink('storage/'.$product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'product deleted successfully.');
    }
    //function update availability for status product
    public function availability(Product $product)
    {
        if ($product->status === "available") {
            $product->status =  "unavailable";
        } else {
            $product->status =  "available";
        }
        $product->update();
        return to_route('products.index')->with('success', "product {$product->name} is {$product->status}");
    }
}
