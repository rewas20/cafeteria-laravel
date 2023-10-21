@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User List</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>

    <table class="table">
        <thead>
            <tr>
                <th >Name</th>
                <th >Profile Pic</th>
                <th >Email</th>
                <th >Role</th>
                <th class='ml-5'>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>
                    <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile Image" class="img-fluid" width="50">
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{$users->links('pagination::bootstrap-5')}}
@endsection