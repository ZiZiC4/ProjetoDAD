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

<router-view></router-view> <!-- Para usar as rotas e não mostrar sempre os users -->

@endsection
@section('pagescript')
<script src="js/app.js"></script>
@stop
