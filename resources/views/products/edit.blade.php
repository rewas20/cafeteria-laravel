@extends('layouts.app')
@section('content')

<div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">update product</div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Edit product</div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card border-0 shadow-lg">
            <div class="card-body">
            <div class="mb-3">
                    <label class="form-label"for="name">product Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"  id="name" value="{{ old('name',$product->name)}}" name="name" placeholder="Enter product's name" >
                     
                    @error('name')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
            </div> 
            <div class="mb-3">
                    <label class="form-label"for="price"></label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price',$product->price)}}"  placeholder="Enter product's price" >
                    @error('price')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
            </div>

            
            <div class="mb-3">
                    <label class="form-label"for="image"> insert image for product</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                     name="image" >
                     @error('image')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    <div class="pt-3">
                            <img src="{{ url('uploads/products/'. $product->image) }}" alt="" width="100" height="100">
                        </div>
            </div>
            <div class="mb-3">
                    <label class="form-label" for="status">status</label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                    @if ($product->status=='available')
                    <option value="{{$product->status}}" selected>{{$product->status}}</option>
                    <option value="unavailable" >unavailable</option>
                    @elseif ($product->status=='unavailable')
                    <option value="{{$product->status}}" selected>{{$product->status}}</option>
                    <option value="available" >available</option>
                    @endif
                    
                    </select>                   
                     @error('status')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
            </div>
            <div class="mb-3">
                    <label class="form-label" for="category">category</label>
                    <select class="form-select @error('category') is-invalid @enderror" name="category">
                    @foreach ($categories as $category)
                            @if ($category->id==$product->category->id)
                                @if($category->trashed())  
                                <option value="{{$category->id}}" selected><span class="text-danger">deleted</span> "{{$category->name}}"</option>              
                                @else  
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                @endif
                            @else 
                                @if(!$category->trashed())  
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endif
                    @endforeach
                    </select>               
                     @error('category')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    
            </div>
            </div>
        </div>
        <button class="btn btn-primary">update products</button>
    </form>
    @endsection