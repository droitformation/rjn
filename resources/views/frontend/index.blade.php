@extends('layouts.master')
@section('content')

    <div class="col-md-12">
        <div id="main-home">
            <!-- Contenu -->

            <h2 class="post-title"><a href="#">Le Recueil de jurisprudence neuchâteloise</a></h2>
            <?php $col = (Auth::check() ? '12' : '8'); ?>

            <div class="row">
                <div class="col-md-{{ $col }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bloc-home">
                                <h4>Recherche par article de loi dans la <span class="text-danger">jurisprudence</span></h4>
                                @include('partials.search.loi')
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bloc-home">
                                <h4>Recherche globale dans la <span class="text-danger">jurisprudence</span></h4>
                                @include('partials.search.global',['content' => 'arret'])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bloc-home">
                                <h4>Recherche globale dans la <span class="text-danger">doctrine</span></h4>
                                @include('partials.search.global',['content' => 'doctrine'])
                            </div>
                        </div>
                    </div>
                </div>

                @if(!Auth::check())
                    <div class="col-md-4">
                        <div class="panel panel-danger">
                            @include('auth.partials.login', ['page' => 'home'])
                        </div>
                        <a class="btn btn-xl btn-inverse btn-demande" style="width: 100%;" href="{{ url('code') }}">
                            <i class="glyphicon glyphicon-info-sign"></i>  &nbsp;Obtenir un accès avec un code</a>
                    </div>
                @endif

            </div>

            <div class="bloc-home">
                <h4>Domaines de <span class="text-danger">jurisprudence</span></h4>
                @include('partials.domains')
            </div>

        </div>
    </div>

@stop