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
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>



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


<div class="container">
    <div class="d-flex flex-wrap" >
        @foreach ($products as $product)
        <a href="" style="text-decoration: none">
        <div class="card m-3 border-0" style="width: 10rem; height:300px; border-radius: 15px; padding:10px 5px">
            <img src="{{ url('uploads/products/' . $product->image) }}" class="card-img-top mx-auto" alt="{{ $product->name }}" style="height: 60%; ">
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

<script>
    $('input[name="search"]').on('input', function() {
        var searchTerm = $(this).val();

        $.get('/search', { search: searchTerm }, function(data) {
            // Update the search results container with the new data
            $('#search-results').html(data);
        });
    });
</script>

