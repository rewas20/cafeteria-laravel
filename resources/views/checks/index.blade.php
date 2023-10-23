@extends('layouts.app')

@section('content')

<div class="container">
    <form class="d-flex justify-content-between my-3" action="{{route('checks.filter')}}" method="post">
    @csrf
            <!-- Select Dropdown to Filter Users -->
            <div class="mb-3">
                <select name="user" id="userFilter" class="form-select form-select-sm">
                    <option value="">All Users</option>
                    @foreach ($allUsers as $user)
                        @if($user->id == $users[0]->id && count($users)==1)
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                            @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>

                        @endif
                    @endforeach
                </select>
            </div>
        <div>
            <label for="date_from">Date From</label>
            <input type="date" value="{{$date_from}}" name="date_from" id="date_from" class="px-2 border-0 bg-body-secondary" style="width: 200px; height: 30px; border-radius: 5px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; letter-spacing:1px">
            
        </div>
        <div>
            <label for="date_to">Date To</label>
            <input type="date" value="{{$date_to}}" name="date_to" id="date_to" class="px-2 border-0 bg-body-secondary" style="width: 200px; height: 30px; border-radius: 5px; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; letter-spacing:1px">
        </div>
        <div>
            <input type="submit" value="Filter" class="btn btn-info text-white fw-bold">
        </div>
</form>
</div>
<div class="w-100">
    <table class="mx-auto w-100">
        <tr class="border-bottom border-dark bg-body-secondary">
            <th class="py-2 px-2 mb-3">User</th>
            <th class="py-2 px-2 mb-3">Total amount</th>
        </tr>
        @foreach($users as $user)
        <?php $flag = false?>
        @foreach($user->orders as $order)
            @if($date_from <= $order->created_at && $order->created_at <= $date_to && $order->status=="Done")
            <?php $flag = true?>
            @endif
        @endforeach
        @if($flag)
        <?php $totalAmount=0 ?>
        <tr class="">
            <td class="py-3 px-2 mb-3">
                <button class="btn btn-info text-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-coll{{$user->id}}" aria-expanded="false" aria-controls="flush-coll{{$user->id}}"><i class="bi bi-plus"></i></button>
                {{$user->name}}
            </td>
                @foreach($user->orders as $order)
                    @if($date_from <= $order->created_at && $order->created_at <= $date_to && $order->status=="Done")
                        @foreach($order->products as $product)
                        <?php $totalAmount += $product->pivot->count * $product->price ?>
                        @endforeach
                    @endif
                @endforeach
                <td class="py-3 px-2 mb-3">{{$totalAmount}} L.E</td>
               
            </tr>
            <tr>
                <td colspan="2" class="position-relative overflow-hidden">
                    <div class="accordion accordion-flush" id="accordionFlushExampleTwo">
                    <div class="accordion-item1">
                        <div id="flush-coll{{$user->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExampleTwo">
                        <table class="mx-auto" style="width:90%">
                            <tr class="border-bottom border-dark bg-info">
                                <th class="py-2 px-2 mb-3">Order Date</th>
                                <th class="py-2 px-2 mb-3">Amount</th>
                            </tr>
                            @foreach($user->orders as $order)
                            @if($date_from <= $order->created_at && $order->created_at < $date_to && $order->status=="Done")
                            <?php 
                            $amount=0 ;
                            
                            ?>
                            <tr class="border-bottom">
                                    <td class="py-2 px-2 mb-3">
                                    <button class="btn btn-secondary text-light collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$order->id}}" aria-expanded="false" aria-controls="flush-collapse{{$order->id}}">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                        {{$order->created_at}}
                                    </td>
                                    @foreach($order->products as $product)
                                        <?php $amount += $product->pivot->count * $product->price ?>
                                    @endforeach
                                    <td class="py-2 px-2 mb-3">{{$amount}} EGP</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="border border-1 border-dark position-relative overflow-hidden">
                                    <div class="accordion accordion-flush d-flex px-4" id="accordionFlushExample"  >
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
                                </td>
                                
                            </tr>
                            @endif
                            @endforeach
                    </table>
                </div>
            </div>

                </div>
                
            </td>
        </tr>
        @endif
        @endforeach

    </table>
</div>
<br>
<br>
@endsection
