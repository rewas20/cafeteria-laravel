@extends('layouts.app')

@section('content')

<div class="container">
  <h2>Add New Category</h2>
  <form method="post" action="{{route('categories.store')}}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control w-50" name="name" id="name" aria-describedby="nameHelp" value="{{old('name')}}">
      @error('name')
      <div><small class="text-danger"> {{ $message }} </small></div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection