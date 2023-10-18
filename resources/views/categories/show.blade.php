@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="card border-info mb-3" style="max-width: 18rem;">
      <div class="card-header">
        {{$category->name}}
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
      <!-- loop through products that has category id to show them -->
    </div>

    <div class="mt-5">
      <a href="{{route('categories.index')}}" class="btn btn-primary">Back to categories</a>
    </div>
  </div>
</div>


@endsection