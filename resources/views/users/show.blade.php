@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">User Information</h3>
            <ul style="list-style: none ;font-size:20px">
                <li><strong>Profile Image:</strong></li>
                <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile Image"  height="150px">
                <br>
                <li ><strong>Name:</strong> {{ $user->name }}</li>
                <br>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <br>
                <li><strong>Role:</strong> {{ $user->role }}</li>
                
            
            </ul>
        </div>
    </div>

    <br>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to User List</a>
</div>
@endsection