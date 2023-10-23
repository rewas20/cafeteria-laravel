@extends('layouts.app')

@section('content')

<h2 class="my-3">Orders</h2>
<div class="w-100">
    <table class="mx-auto w-100">
        <tr class="border-bottom border-dark bg-body-secondary">
            <th class="py-2 px-2 mb-3">Order Date</th>
            <th class="py-2 px-2 mb-3">User</th>
            <th class="py-2 px-2 mb-3">Room</th>
            <th class="py-2 px-2 mb-3">Status</th>
            <th class="py-2 px-2 mb-3">Action</th>
        </tr>
        @foreach($orders as $order)
            <tr class="">
                <td class="py-3 px-2 mb-3">{{$order->created_at}}</td>
                <td class="py-3 px-2 mb-3">{{$order->user->name}}</td>
                <td class="py-3 px-2 mb-3">{{$order->user->room}}</td>
                <td class="py-3 px-2 mb-3">{{$order->status === "Out"?"Out for Delivery":$order->status}}</td>
                <td class="py-3 px-2 mb-3 d-flex">
                    <a href="{{route('status-orders.edit',$order->id)}}" class="btn btn-primary me-2">Deliver</a>
                    <form action="{{route('status-orders.destroy',$order->id)}}" method="post" class="me-2">
                        @csrf
                        @method('delete')

                        <input type="submit"  class="btn btn-danger" value="Delete">
                    </form>
                    <button class="btn btn-info text-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$order->id}}" aria-expanded="false" aria-controls="flush-collapse{{$order->id}}">
                        Details
                    </button>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="border border-1 border-dark position-relative overflow-hidden" id="content-product">
                <div class="accordion accordion-flush d-flex " id="accordionFlushExample"  >
                    <?php
                        $total =0;
                    ?>
                    @foreach ($order->products as $product)
                        <div class="accordion-item " >
                            <div id="flush-collapse{{$order->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="card border-0 m-3 position-relative" style="height:300px; border-radius: 15px; padding:10px 5px;">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top mx-auto" alt="{{ $product->name }}" style="width:100px; height: 60%;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                                        <h5 class="card-title" style="font-size: 20px; font-weight:bold;">{{ $product->name }}</h5>
                                        <p class="card-text position-absolute top-0 end-0 p-2 bg-white rounded-circle border" style="font-size: 20px; font-weight:bold;">{{ $product->price }} L.E</p>
                                        <p class="card-text" style="font-size: 20px; font-weight:bold;">Count: {{ $product->pivot->count }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    <?php
                        $total += $product->pivot->count * $product->price;
                    ?>
                    @endforeach
                    <p class="card-text position-absolute bottom-0 end-0 p-2 mx-3 my-2 bg-white rounded border" style="font-size: 20px; font-weight:bold;">Total EGP {{ $total}} L.E</p>
                </div>

                </td colspan="4">
            </tr>
        @endforeach
    </table>
</div>
<br>
<br>
{{$orders->links('pagination::bootstrap-5')}}
<script>
    $("#detail-product").click(function(){
        console.log('hello');
    });
</script>
@endsection
