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
    <script src="js/app.js"></script>
</body>
</html>

=======


<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>type</th>
            <th>photo</th>
            <th>price</th>
            <th>description</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="product in products"  :key="product.id" :class="{active: currentproduct === product}">
            <td>@{{ product.name }}</td>
            <td>@{{ product.type }}</td>
            <td>@{{ product.photo }}</td>
            <td>@{{ product.price }}</td>
            <td>@{{ product.description }}</td>
        </tr>
    </tbody>
</table>
</div>






<router-view></router-view> <!-- Para usar as rotas e não mostrar sempre os users -->

@endsection
@section('pphotoscript')
<script src="js/app.js"></script>
@stop
