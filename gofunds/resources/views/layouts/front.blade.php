<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/front/sass/app.scss', 'resources/front/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    GOFUNDS-F
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li>
                            <form action="{{route('front-index')}}" method="get">
                                <div class="container">
                                    <div class="row justify-content-left">
                                        <div class="col-8 m-1">
                                            @if(isset($hts))
                                            <select class="form-select" name="hash_tags">
                                                <option value="0" selected>Hash-tag select</option>
                                                @foreach($hts as $k => $ht)
                                                <option value="{{$ht->id}}">{{$ht->text}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 m-1">
                                            <button type="submit" class="btn btn-outline-primary"> #Filter</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </li>
                        @if($sort_like > 0)
                        <li class="nav-item">
                            <div>
                                <form action="{{route('front-index')}}" method="get">
                                    <button class="btn btn-outline-info m-1">Sort by donate</a>
                                        <input type="hidden" name="sort_like" value="0">
                                </form>
                            </div>
                        </li>
                        <li> 
                            <div class="m-2">
                                Sorted by likes
                            </div>
                        </li>
                        @else
                        <li class="nav-item">
                            <div>
                                <form action="{{route('front-index')}}" method="get">
                                    <button class="btn btn-outline-info m-1">Sort by like</a>
                                        <input type="hidden" name="sort_like" value="1">
                                </form>
                            </div>
                        </li>
                        <li> 
                            <div class="m-2">
                                Sorted by lack of donates
                            </div>
                        </li>
                        @endif
                        @if(Auth::id() && $hist_add)
                        <li>
                        <a href="{{route('front-create')}}" class="btn btn-outline-info m-1btn btn-outline-info m-1" >ADD history</a>
                        </li>
                        <li> 
                            <div class="m-2">
                                Add Your new history
                            </div>
                        </li>
                        @endif
                        @if(Auth::id() && $hist_edit)
                        <li>
                        <a href="{{route('front-edit', $hist_edit_obj)}}" class="btn btn-outline-info m-1btn btn-outline-info m-1" >EDIT history</a>
                        </li>
                        <li> 
                            <div class="m-2">
                                Edit Your history
                            </div>
                        </li>
                        @endif
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
            @yield('content')
        </main>
    </div>
</body>
</html>
