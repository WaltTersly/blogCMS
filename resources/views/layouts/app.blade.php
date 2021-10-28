<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session() ->get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session() ->get('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session()->has('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session() ->get('info')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @auth
            <aside class="float-left py-2 my-2 mx-5">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            Navigationn panel
                        </div>
                         <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('home') }}"> Home</a>
                            </li>
                            {{-- chcek and ensure only admins can access the this routes --}}

                            @if (Auth::user()->admin)
                                
                            <li class="list-group-item">
                                <a href="{{ route('users') }}"> Users</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('user.create') }}"> New User</a>
                            </li>

                            @endif

                            <li class="list-group-item">
                                <a href="{{ route('user.profile') }}"> My Profile</a>
                            </li>
                             <li class="list-group-item">
                                 <a href="{{ route('post.create') }}"> Create new Post</a>
                             </li>
                             <li class="list-group-item">
                                <a href="{{ route('posts') }}">  Posts</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('posts.trashed') }}">  Trashed Posts</a>
                            </li>
                             <li class="list-group-item">
                                 <a href="{{ route('category.create')}}"> create new Categories</a>
                             </li>
                             <li class="list-group-item">
                                <a href="{{ route('categories')}}"> Categories</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('tags')}}"> Tags</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('tag.create')}}"> create new Tags</a>
                            </li>
                            @if (Auth::user()->admin)
                                
                            <li class="list-group-item">
                                <a href="{{ route('settings') }}"> Settings </a>
                            </li>

                            @endif
                         </ul>
                    </div>
                </div>
             </aside> 
             @yield('content')
            @else
            @yield('content')
            @endauth

            
            
        </main>
    </div>
    @yield('scripts')
</body>
</html>
