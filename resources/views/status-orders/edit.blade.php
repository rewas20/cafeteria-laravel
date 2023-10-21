@extends('layouts.app')

@section('content')


<form action="{{route('status-orders.update',$order->id)}}" method="post">
    @csrf
    @method('put')
    <div class="my-3">
        <label for="status">Status</label>
        <select name="status" id="status">
            @if($order->status == "Processing")
            <option value="{{$order->status}}" selected>{{$order->status}}</option>
            <option value="Out">Out for delivery</option>
            <option value="Done">Done</option>
            @elseif($order->status == "Out")
            <option value="{{$order->status}}" selected>Out for delivery</option>
            <option value="Processing" >Processing</option>
            <option value="Done">Done</option>
            @else
            <option value="{{$order->status}}" selected>{{$order->status}}</option>
            <option value="Processing" >Processing</option>
            <option value="Out">Out for delivery</option>
            @endif
        </select>
    </div>
    <input type="submit" class="btn btn-primary">
</form>
<div class="my-3">
<a href="{{route('status-orders.index')}}" class="btn btn-secondary">back</a>
</div>
@endsection