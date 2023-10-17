@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">User Information</h3>
            <ul>
                <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile Image" class="img-fluid" width="50">
                <li><strong>Name:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Role:</strong> {{ $user->role }}</li>
                <li><strong>Profile Image:</strong></li>
            
            </ul>
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to User List</a>
</div>
@endsection