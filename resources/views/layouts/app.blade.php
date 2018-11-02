<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="d-inline-block align-center" src="{{ asset('img/caap.png') }}" width="48" height="30" alt="caap logo">                    
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}"><i class="s7 s7-home"></i> Home</a>
                        </li>                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="s7 s7-users"></i> Voters
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('voters.index') }}"><i class="s7 s7-users"></i> Voters</a>
                                <a class="dropdown-item" href="{{ route('offices.index') }}"><i class="s7 s7-box1"></i> Offices</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('voters.selfservice') }}"><i class="s7 s7-pen"></i> Self Service</a>                                
                            </div>
                        </li>               
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="s7 s7-news-paper"></i> Elections
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('elections.index') }}"><i class="s7 s7-news-paper"></i> Elections</a>
                                <a class="dropdown-item" href="{{ route('positions.index') }}"><i class="s7 s7-ribbon"></i> Positions</a>          
                                <a class="dropdown-item" href="{{ route('candidates.index') }}"><i class="s7 s7-user"></i> Candidates</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('votes.index') }}"><i class="s7 s7-pen"></i> Votes</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('votes.reports') }}"><i class="s7 s7-graph"></i> Reports</a>
                            </div>
                        </li>                                                     
                        
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset('img/avatar.png') }}" class="d-inline-block align-center rounded-circle" alt="Avatar" width="32" height="24"> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"><i class="s7 s7-settings"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="s7 s7-left-arrow"></i> {{ __('Logout') }}
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">        
        <main class="py-4">
            @include('alert')
            @unless (Route::is('home'))                
            <div class="container">
                <div class="row">     
                    <div class="col-8">
                        <p class="lead">
                            <h5>{{ optional($active_election)->title }}</h5>
                        </p>
                    </div>           
                    @auth                        
                    <div class="col-4">                        
                        @include('breadcrumbs')
                    </div>   
                    @endauth
                </div>
            </div>
            @endunless
            @yield('content')
        </main>
        
        <div class="footer">
            <p class="text-center"><small>&copy; Copyright {{ now()->year }}.</small></p>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>    
@stack('scripts')
</body>
</html>
