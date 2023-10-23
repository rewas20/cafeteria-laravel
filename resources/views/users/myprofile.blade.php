@extends('layouts.app')

@section('content')



<div class="row justify-content-between align-items-center">
    <div class="col-sm-12 col-md-3">
          <img src="{{Auth::user()->profile_pic==null? asset('profile/profile_pic.jpg'):asset('storage/'.$user->profile_pic)}}"  width="100%" style="border-radius:20px" alt="">
          <p class="my-3 fs-2">{{$user->name}}</p>
          <div class="edit my-3">
            <a href="{{route('users.edit',$user)}}" class="btn btn-secondary w-100 opacity-75" >Edit Profile</a>
          </div>
    </div>
<div class="col-sm-12 col-md-8">
       @can('is-admin') <p class="fs-3 mb-5">Role: <span class="px-2 py-1 rounded border border-1 border-primary">{{$user->role}}</span></p>@endcan
        <p class="fs-4 mb-5">Email: <span class="px-2 py-1 rounded border border-1 border-primary">{{$user->email}}<span></p>
        <p class="fs-4 mb-5">Room: <span class="px-2 py-1 rounded border border-1 border-primary">{{$user->room??'No Room'}}<span></p>
@if($user->email_verified_at)
            <p class="fs-4 mb-5">Status Email: <span class="px-2 py-1 rounded border border-3 border-success">Verified<span></p>
            
        @else
            <p class="fs-4 mb-5">Status Email: <span class="px-2 py-1 rounded border border-3 border-danger">Not verfied yet<span></p>
            <a href="{{route('verification.notice')}}" class="btn btn-danger">Verify your email now</a>
        @endif
    </div>

</div>

@endsection