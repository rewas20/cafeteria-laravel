@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use the PUT method for updating -->

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" value="{{old('name',$user->name) }}"  id="name" name="name"  >

            @error('name')
            <p class="text-danger fw-bolder mt-2">{{$message}}</p>
        @enderror

        </div>
        <br>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ old('email',$user->email) }}" >
            @error('email')
            <p class="text-danger fw-bolder mt-2">{{$message}}</p>
        @enderror
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" id="role" name="role">
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
            <p class="text-danger fw-bolder mt-2">{{$message}}</p>
        @enderror
        </div>

        <div class="form-group">
            <label for="image">Profile Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            @error('image')
                <p class="text-danger fw-bolder mt-2">{{$message}}</p>
            @enderror
        </div>
        <div>
            <img src="{{asset('storage/'.$user->profile_pic)}} " width="100px" alt="">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="{{ route('users.show', $user->id) }}" class="btn btn-secondary mt-3">Back to User Details</a>
</div>
@endsection
