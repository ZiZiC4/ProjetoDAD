<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @yield('extrastyles')
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>

<div class="avatar-area">
             @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <li class="nav-item dropdown">
                            <!--<a href="{{ url('/') }}">{{Auth::user()->name}}</a>-->
                            <a>{{Auth::user()->name}}</a>
                            <img src="{{Auth::user()->foto ? asset('storage/fotos/' . Auth::user()->foto) : asset('img/default_img.png') }}">
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            
<body>
    <div class="container" id="app">
        @yield('content')
    </div>

    <header>

        <div id="menuIcon">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </header>

    @yield('pagescript')
</body>

<div class="container">
    	<nav>
            <ul>
            	<!--no <li> inserir class="{{Route::currentRouteName() == 'home' ? 'sel' : ''}}" para ver o que foi selecionado -->

                <li>
                    <i class="fas fa-info-circle"></i>
                    <a>Home Page</a>
                </li>
                <li>
                    <i class="fas fa-box"></i>
                    <a>Users</a>
                </li>
                <li>
                    <i class="far fa-file"></i>
                    <a>Contas</a>
                </li>
                <li>
                    <i class="fab fa-wpforms"></i>
                    <a>Perfil</a>
                </li>
                <li>
                    <i class="fab fa-wpforms"></i>
                    <a>Estatisticas</a>
                </li>
            </ul>
        </nav>
        <section id="main">
        	<div class="left-content">
                 @yield('content')
        	</div>
        	<footer>
                <p>
                    © <a>Food@Home</a>
                </p>
            </footer>
        </section>
    </div>

<style>
    .nav {
        display: flex;
        list-style: none;
        padding: 7px 0;
        margin: 0;
        justify-content: inline-flex;
        background: #e9ecef;
        border-bottom: 1px solid lightgrey;
        margin-bottom: 24px;
    }

    .nav a {
        color: #636b6f;
        padding: 0 15px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
</style>

</html>
