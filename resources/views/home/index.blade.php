@extends('layouts.app')

@section('content')
<style>
    fieldset, legend {
   all: revert;
   margin-inline-start: 0px !important;
   margin-inline-end: 0px !important;
}
fieldset{
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
</style>

@can('is-user')
    @if(!auth()->user()->email_verified_at)
    <div class="alert alert-danger text-capitalize">
        <p>please verify your account </p>
        <a href="{{route('verification.notice')}}" class="btn btn-danger">Verify your email now</a>
    </div>
    @endif
@endcan
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
<div class="container">
    <div class="row">
        @can('is-admin')
        <div class="col-md-6">
           <form id="form-chanage" action="{{route('home.choose')}}" method="post">
            @csrf
             <!-- Select Dropdown to Filter Users -->
             <div class="mb-3">
                <h2 value="">Add To User</h2>
                <select onchange="(document.getElementById('form-chanage').submit())" name="user" type="submit" id="userFilter" class="form-select form-select-sm">
                    <option value="">All Users</option>
                    @foreach ($users as $user)=
                        @if(session('user') && $user->id == session('user')->id )
                       <option value="{{ $user->id }}" selected> {{ $user->name }}</option>
                        @else
                       <option value="{{ $user->id }}"> {{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
           </form>
        </div>
        @endcan
      <div class="col-md-5">
    <!-- Search Input -->
    <div class="mb-3">
        <h2>Search Products</h2>
        <form action="{{ route('search') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control" aria-label="search" aria-describedby="basic-addon1" placeholder="Search...">
            <button type="submit" class="btn btn-secondary">Search</button>    
        </form>

    </div>
    </div>
</div>
@can('is-user')
    @can('is-verified')
        @if($userAdded->orders->last())
        @foreach($userAdded->orders->last()->products as $product)
        <h3 >Latest order</h3>
        <div class="card m-2 border-0 d-flex" style="width: 50px; border-radius: 15px; padding:5px">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top mx-auto img-fluid" alt="{{ $product->name }}" >
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="card-title" style="font-size: 15px; font-weight:bold;">{{ $product->name }}</h5>
            </div>
        </div>
        @endforeach
        <hr>
        @endif
    @endcan
@endcan
    <div class="d-flex flex-row flex-wrap">
                <div class="col-md-6">
                
                    <fieldset class="card-list border rounded-2 col-md-9">
                        <legend class="w-auto fs-5 p-2 bg-white rounded border border-1 text-capitalize fw-bolder">menu check list</legend>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th class="text-center">Quantity</th>   
                                <th>Action</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                
                            @php 
                            $total = 0;
                             @endphp
                                    @foreach ((array) session('cart') as $card_id => $card_details)
                                    @php
                                        $total += $card_details['price'] * $card_details['quantity']
                                    @endphp 
                            <tr>                                
                                <td>
                                      
                                <img src="{{ asset('storage/' . $card_details['image']) }}"class="card-img-top mx-auto"  style="height: 80px; width: 80px;" alt="{{$card_details['name']}}">
                                </td>
                                <td class="text-center ">
                                    <h5 class="card-title" style="font-size: 16px; font-weight:bold;">{{$card_details['name']}}</h5> 
                                </td>
                                <td>
                                    {{$card_details['price']}}
                                
                                </td>
                                <td class="d-flex align-items-start" style="height:100px;">
                                <form action="{{route('carts.increment',$card_id)}}" class="m-0" method="post">
                                    @csrf
                                    <button  type="submit" class="btn btn-primary" name="plus">+</button>
                                </form>
                                <input type="text"  value="{{$card_details['quantity']}}" disabled class="form-control text-center m-0">
                                <form action="{{route('carts.decrement',$card_id)}}" class="m-0" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" name="minus">-</button>
                                </form>
                                </td>
                                <td>
                            <form id="product-edit-action-{{$card_id }}" action="{{ route('carts.destroy',$card_id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')"  class="btn btn-danger"><i class="bi bi-x fs-5"></i></button>
                            </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="{{route('order-products.create')}}" methos="post">
                        @csrf
                        <div class="mb-3">
                            <label for="notes">Notes:</label>
                            <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
                        </div>
                        @can('is-verified')
                        <div class="mb-3 d-flex ">
                            <label for="room fw-bolder">Room:</label>
                            <p class="ms-4 fw-bold text-capitalize border border-1 px-4"> {{session('user')->room??'no room'}}</p>
                        </div>
                        @endcan
                        <input type="submit" class="btn btn-primary" style="width:10rem ;" value="Confirm">
                    </form>
                    <div class="text-end mb-2">
                        <span class="float-right fs-4 fw-bolder">Total Price:{{$total}}</span>
                    </div>
                    </fieldset>
                </div>
<div class="container col-md-6">
    <div class="d-flex flex-wrap" >
        <?=
         $products
        ?>
        @foreach ($products as $product)
        <form action="{{route('carts.update',$product->id)}}" method="post">
                    @csrf
                    @method('put')
        <button type="submit" style="background-color:#f8fafc; border: none; text-decoration: none;">
        <div class="card m-3 border-0" style="width: 10rem; height:300px; border-radius: 15px; padding:10px 5px">
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top mx-auto" alt="{{ $product->name }}" style="height: 60%; ">
            <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                <h5 class="card-title" style="font-size: 20px; font-weight:bold;">{{ $product->name }}</h5>
                <p class="card-text" style="font-size: 20px; font-weight:bold;">{{ $product->price }} L.E</p>
            </div>
        </div>
        </button>
        </form>
        @endforeach
        <br>
        <br>
        {{$products->links('pagination::bootstrap-5')}}
    </div>
</div>





@endsection

<script>
    $('input[name="search"]').on('input', function() {
        var searchTerm = $(this).val();

        $.get('/search', { search: searchTerm }, function(data) {
            // Update the search results container with the new data
            $('#search-results').html(data);
        });
    });
</script>

