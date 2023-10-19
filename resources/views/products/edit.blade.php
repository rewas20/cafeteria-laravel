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
                            <option value="available">available</option>
                            <option value="unavailable">unavailable</option>
                    </select>                   
                     @error('status')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                    <div class="pt-3">
                            <input class="form-select" style="width: 50%;" value="{{ old('status',$product->status)}}" disabled alt="">
                    </div>
            </div>
            </div>
        </div>
        <button class="btn btn-primary">update Employee</button>
    </form>
    @endsection