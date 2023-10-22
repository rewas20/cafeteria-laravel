<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav me-auto" style="list-style: none;  color: white; display: inline-block;  ">
                        <li class="nav-item" style="display: inline-block; padding: 0 0.5rem; text-align: center; cursor: pointer;">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>


                        <li class="nav-item" style="display: inline-block; padding: 0 0.5rem; text-align: center; cursor: pointer;">
                            <a class="nav-link" href="#">My Orders</a>
                        </li>

                        <li class="nav-item" style="display: inline-block; padding: 0 0.5rem; text-align: center; cursor: pointer;">
                            <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                        </li>

                        <li class="nav-item" style="display: inline-block; padding: 0 0.5rem; text-align: center; cursor: pointer;">
                            <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                        </li>
                         


                        <li class="nav-item" style="display: inline-block; padding: 0 0.5rem; text-align: center; cursor: pointer;">
                            <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                        </li>
                        <li class="nav-item" style="display: inline-block; padding: 0 0.5rem; text-align: center; cursor: pointer;">
                            <a class="nav-link" href="#">Manual Orders</a>
                        </li>
                        <li class="nav-item" style="display: inline-block; padding: 0 0.5rem; text-align: center; cursor: pointer;">
                            <a class="nav-link" href="#">Checks</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                        <li>
                         
                        </li>



                            <li class="nav-item dropdown" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    
                                    
                                    <img src="{{ asset('storage/' . Auth::user()->profile_pic) }}" class="user-image" style="width: 40px; height: 40px; border-radius: 50%;">
                                  
                                    {{ Auth::user()->name }}

                            
                                </a>
                                

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                    <a class="dropdown-item mb-2" href="{{ route('user.myprofile') }}">My Profile</a>
                                    @if(!Auth::user()->email_verified_at)
                                        <a href="{{route('verification.notice')}}" class="text-decoration-none text-danger ps-3">Verify your email</a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li >
                           
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <main class="py-4">
                @yield('content')
            </main>
        </div>


        <div class="container">

            @yield('body')
            </div>
            
    </div>
</body>
</html>
