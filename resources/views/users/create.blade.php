@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Add User</h1>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control " id="name" name="name" value="{{ old('name') }}" >
            @error('name')
                <p class="text-danger fw-bolder mt-2">{{$message}}</p>
            @enderror
        </div>
        <br>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control " id="email" name="email" value="{{ old('email') }}" >
            @error('email')
                <p class="text-danger fw-bolder mt-2">{{$message}}</p>
            @enderror
        </div>

        <br>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control " id="password" name="password" >
             @error('password')
                <p class="text-danger fw-bolder mt-2">{{$message}}</p>
            @enderror
        </div>
        
        <br>
        
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"   >
            @error('password_confirmation')
                <p class="text-danger fw-bolder mt-2">{{$message}}</p>
            @enderror
        </div>

        <br>

        <div class="form-group">
            <label for="image">Profile Image:</label>
            <input type="file" class="form-control-file " id="image" name="image" accept="image/*"  >
             @error('image')
                <p class="text-danger fw-bolder mt-2">{{$message}}</p>
            @enderror
        </div>

        <br>

        <div class="form-group">
            <label for="room">room:</label>
            <input type="text" class="form-control " id="room" name="room"  value="{{old('room') }}">
             @error('room')
                <p class="text-danger fw-bolder mt-2">{{$message}}</p>
            @enderror
        </div>


<br>

        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control " id="role" name="role" >
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
             @error('role')
                <p class="text-danger fw-bolder mt-2">{{$message}}</p>
            @enderror
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
@endsection
