@extends('layouts.login')
@section('content')

    <div class="col-md-12">
        <div class="panel panel-danger">
            @include('auth.partials.login', ['page' => 'login'])
        </div>
        <p class="text-muted text-center">- Ou -</p>
        <a class="btn btn-xl btn-inverse btn-demande" href="{{ url('code') }}">
            <i class="glyphicon glyphicon-info-sign"></i>  &nbsp;Obtenir un accès avec un code
        </a>
    </div>

@endsection
