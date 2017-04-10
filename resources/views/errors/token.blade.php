
@extends('layouts.master')
@section('content')

<div class="col-md-12">
    <div id="main-content" class="text-center">
        <!-- Contenu -->
        <h1>Ouh oh</h1>
        <h3>Votre session à expiré</h3>
        <div id="pagepastrouve">
            <img style="max-height: 140px;" src="<?php echo asset('images/time.svg'); ?>" alt="token">
        </div>
        <h1><a class="btn btn-sm btn-danger" href="{{ Request::url() }}">Rafraichir la page</a></h1>
    </div>
</div><!--END CONTENT-->

@stop