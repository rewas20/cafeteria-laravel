<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">
              Admin create products
            </div>
        </div>
    </div>
    <div class="container py-3">
        <div class="d-flex justify-content-between">
            <div class="h4">products</div>
                <!-- <div>
                    <a href="{{route('products.index')}}" class="btn btn-primary">back</a>
                </div> -->
        </div>
        <form action="{{route('products.store')}}" method="post" class="" enctype="multipart/form-data">
            @csrf
        <div class="card border-0 shadow-lg">
            <div class="card-body">
            <div class="mb-3">
                    <label class="form-label"for="name">product Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"  id="name" value="{{ old('name')}}" name="name" placeholder="Enter product's name" >
                     
                    @error('name')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
            </div> 
            <div class="mb-3">
                    <label class="form-label"for="price"></label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')}}"  placeholder="Enter product's price" >
                    @error('price')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
            </div>

            
            <div class="mb-3">
                    <label class="form-label"for="image"> insert image for product</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                     name="image" >
                     @error('image')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
            </div>
            <div class="mb-3">
                    <label class="form-label" for="status">status</label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                            <option value="available">available</option>
                            <option value="unavailable">unavailable</option>
                    </select>                   
                     @error('status')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
            </div>
            </div>
        </div>
        <button class="btn btn-primary">save</button>
        </form>
    </div>
    </body>
</html>