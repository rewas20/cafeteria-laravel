@extends('layouts.app')
    @section('content')
<div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">
                products
            </div>
        </div>
    </div>
    <div class="container py-3">
        <div class="d-flex justify-content-between">
            <div class="h4">products</div>
        </div>
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr class="">
                        <th class="">ID</th>
                        <th class="">image</th>
                        <th class="">Name of product</th>
                        <th class="">price</th>
                        <th class="">status</th>
                        <th colspan="3" class="">Actions</th>
                    </tr>
                        @if($products->isNotEmpty())
                        @foreach ($products as $product)
                        <tr valign="top">
                        <td class="">{{ $product->id }}</td>
                        <td class="">  
                        @if($product->image != '' && file_exists(public_path() .'/uploads/products/'. $product->image))
                            <img src="{{ url('uploads/products/'. $product->image) }}" alt="" width="40" height="40" class="rounded-circle">
                            @else
                            <img src="{{ url('assets/images/no-image.png') }}" alt="" width="40" height="40" class="rounded-circle">
                            @endif
                            </td>
                        <td class="">{{$product->name }}</td>
                        <td class="">{{ $product->price }}</td>
                        <td class="">{{ $product->status }}</td>
                    <td>
                    <a href="{{ route('products.edit',$product->id) }}"  class="btn btn-info">update</a>
                    <a  href="#" onclick="deleteProduct('{{ $product->id}}');" class="btn btn-danger">Delete</a></td>
                    <form id="product-edit-action-{{ $product->id }}" action="{{ route('products.destroy',$product->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4">Not Found</td>
                    </tr>
                    @endif
                </table>
                
            </div>
        </div>
    </div>
    @endsection
    <script>
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete?")) {
            document.getElementById('product-edit-action-'+id).submit();
        }
    }
</script>