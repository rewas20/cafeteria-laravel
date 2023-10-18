@extends('layouts.app')

@section('content')

<div class="container">
  <h2>Edit Category</h2>
  <form method="post" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control w-50" name="name" id="name" aria-describedby="nameHelp" value="{{ old('name', $category->name) }}">
      @error('name')
      <div><small class="text-danger"> {{ $message }} </small></div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection