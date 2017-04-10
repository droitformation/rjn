
@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="page-header text-align-center">
            <h1 class="title uppercase">Ouh oh</h1>
            <h2 class="subtitle">Nous n'avons pas trouvé la page</h2>
        </div><!--END PAGE-HEADER-->
    </div>
</div>

<div class="row">

    <div id="inner-content" class="col-md-12 text-align-center">
        <div id="pagepastrouve">
            <img src="<?php echo asset('images/pagepastrouve.svg'); ?>" alt="404">
            <p class="text-center"><a class="button small grey" href="{{ url('/') }}">Retour à la page d'accueil</a></p>
        </div>
    </div>

</div><!--END CONTENT-->

@stop