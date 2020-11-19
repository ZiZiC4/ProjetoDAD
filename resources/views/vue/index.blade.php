@extends('master')

@section('title', 'Food@Home')

@section('content')

<ul class="nav">
    <li><router-link to="/">Home </router-link></li>
    <li><router-link to="/users">Users</router-link></li>
</ul>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>



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
