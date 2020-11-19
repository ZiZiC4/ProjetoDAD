<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>
            
<body>
    <div class="container" id="app">
    </div>

    <header>

        <div id="menuIcon">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </header>

<div class="container">
    	<nav>
            <ul>

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
                 
        	</div>
        	<footer>
                <p>
                    © <a>Food@Home</a>
                </p>
            </footer>
        </section>
    </div>
</body>

</html>
