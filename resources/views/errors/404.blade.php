
@extends('layouts.master')
@section('content')

<div class="col-md-12">
    <div id="main-content" class="text-center">
        <!-- Contenu -->
        <h1>Ouh oh</h1>
        <h2>Nous n'avons pas trouvé la page</h2>
        <div id="pagepastrouve">
            <img src="<?php echo asset('images/pagepastrouve.svg'); ?>" alt="404">
        </div>
        <h1><a class="btn btn-sm btn-danger" href="{{ url('/') }}">Retour à la page d'accueil</a></h1>
    </div>
</div><!--END CONTENT-->

@stop