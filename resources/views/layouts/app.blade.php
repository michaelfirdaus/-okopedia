<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand text-success font-weight-bold" href="{{ url('/') }}">
                    $okopedia
                </a>
                @if(Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register' && (!Auth::check() || Auth::check() && Auth::user()->admin != 1))
                    <div class="container float-right">
                        <form action="{{ route('user.product.search') }}" method="POST" role="search" class="justify-content-end">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" id="search"
                                    placeholder="Search product..." size="40"> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <span class="fas fa-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                @endif
                @if(Auth::check())
                    @if(!Auth::user()->admin)
                        <div class="container d-flex justify-content-end">
                            <div class="my-3">
                                <a href="{{ route('user.cart.show') }}" class="btn btn-default mx-3">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="badge badge-success text-white font-weight-bold">
                                        {{ $carts->count() > 1 ? $carts->count(). " Items" :  $carts->count()." Item"}}
                                    </span>
                                </a>

                                <a href="{{ route('user.transaction.history') }}" class="btn btn-success">
                                    <i class="fas fa-history"></i> History
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a href="{{ route('user.profile') }}" class="dropdown-item">Update My Profile</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                                @if($user->avatar != null)
                                <img src="{{ asset('uploads/avatars/'.$user->avatar) }}" alt="{{ $user->name }}" width=60px height=50px>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if(Auth::check())
            @if(Auth::user()->admin)
                <div class="container mt-4">
                    <div class="row mt-4">
                        <div class="col-md">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{ route('category.create') }}">Add New Category</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('categories') }}">View All Categories</a>
                                </li>              
                                <li class="list-group-item">
                                    <a href="{{ route('product.create') }}">Add New Product</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('products') }}">View All Products Details</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    @yield('content')
                </div>
            @endif
        @endif

        @if(!Auth::check())
            <div class="container">
                @yield('content')
            </div>
        @endif

    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
        @endif
    </script>

</body>
</html>
