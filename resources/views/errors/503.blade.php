
@extends('layouts.master')
@section('content')

<div class="col-md-12">
    <div id="main-content" class="text-center">
        <!-- Contenu -->
        <h1>Ouh oh</h1>
        <h3>Problème temporaire, revenez dans quelques minutes</h3>
        <div id="pagepastrouve">
            <img style="max-height: 180px;" src="<?php echo asset('images/warning.svg'); ?>" alt="404">
        </div>
        <h1><a class="btn btn-sm btn-danger" href="{{ url('/') }}">Retour à la page d'accueil</a></h1>
    </div>
</div><!--END CONTENT-->

@stop