@extends('layouts.app')

@section('content')
<div class="container">

    <form class="d-flex justify-content-between my-3" action="{{route('orders.filter')}}" method="post">
        @csrf
        <div>
            <label for="date_from">Date From</label>
            <input type="date" name="date_from" id="date_from" class="px-2 border-0 bg-body-secondary" style="width: 200px; height: 30px; border-radius: 5px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; letter-spacing:1px">
        </div>
        <div>
            <label for="date_to">Date To</label>
            <input type="date" name="date_to" id="date_to" class="px-2 border-0 bg-body-secondary" style="width: 200px; height: 30px; border-radius: 5px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; letter-spacing:1px">
        </div>
        <div>
            <input type="submit" value="Filter" class="btn btn-info text-white fw-bold">
        </div>
    </form>

    <table class="table table-info table-striped">
        <tr>
            <th>Order Date</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>

        @foreach($orders as $order)
        <tr>
            <td>
                {{$order->created_at}}
                <span style="float: right; margin-right: 5px;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#T{{$order->id}}" aria-expanded="false" aria-controls="T{{$order->id}}">
                            +
                        </button>
                    </h2>
                </span>
            </td>
           
            <td> {{$order->status=="Out"?'Out for delivery':$order->status}}</td>

            <?php
                $orderTotal =0;
            ?>
            @foreach($order->products as $product)
            <?php
                $orderTotal += $product->price *$product->pivot->count;
            ?>
            @endforeach
            <td>
                {{ $orderTotal}} EGP
            </td>

            <td>
                @if($order->status === 'Processing')
                <form action="{{route('orders.destroy', $order->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-link text-dark" onclick="return confirm('Are you sure you want to delete this order?')">
                </form>
                @endif
            </td>




        </tr>
        <tr>
            <td colspan="4">
                <div class="accordion-item">
                    <div id="T{{$order->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body d-flex">
                            @foreach($order->products as $product)
                            <div class="card border-0 m-3 position-relative bg-transparent" style="height:300px; width:200px; border-radius: 15px; padding:10px 5px">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top mx-auto" alt="{{ $product->name }}" style="height: 60%;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                    <h5 class="card-title" style="font-size: 20px; font-weight:bold;">{{ $product->name }}</h5>
                                    <p class="card-text position-absolute top-0 end-0 p-2 bg-white rounded-circle border" style="font-size: 20px; font-weight:bold;">{{ $product->price }} L.E</p>
                                    <p class="card-text" style="font-size: 20px; font-weight:bold;">Count: {{ $product->pivot->count }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach

    </table>

    <div class="d-flex justify-content-right">
        <h3>
            Total EGP {{$total}}
        </h3>
    </div>


    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>




</div>

@endsection