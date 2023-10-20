@extends('layouts.app')

@section('content')
 

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Select Dropdown to Filter Users -->
            <div class="mb-3">
                <h2 value="">Add To User</h2>
                <select id="userFilter" class="form-select form-select-sm">
                    <option value="">All Users</option>
                    @foreach ($users->where('role', 'user') as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>



      <div class="col-md-5">
    <!-- Search Input -->
    <div class="mb-3">
        <h2>Search Products</h2>
        <form action="" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control" placeholder="Search..." id="search-input">
        </form>
    </div>
    </div>
</div>

<div class="container">
    <div class="d-flex flex-wrap" >
        @foreach ($products as $product)
        <a href="" style="text-decoration: none">
        <div class="card m-3" style="width: 10rem; border-radius: 15px; padding:10px">
            <img src="{{ url('uploads/products/' . $product->image) }}" class="card-img-top mx-auto" alt="{{ $product->name }}" style="height: 80px; width: 80px;">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="card-title" style="font-size: 20px; font-weight:bold;">{{ $product->name }}</h5>
                <p class="card-text" style="font-size: 20px; font-weight:bold;">{{ $product->price }} L.E</p>
            </div>
        </div>
         </a>
        @endforeach
    </div>
</div>






@endsection

