@extends('layouts.admin')
@section('content')

    <div class="row">

        <div class="col-md-4">
            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4><i class="fa fa-edit"></i> &nbsp;Derniers Arrêts</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titre</th>
                                <th>Volume</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!$arrets->isEmpty())
                            @foreach($arrets as $arret)
                                <tr>
                                    <td><a class="btn btn-sm btn-info" href="{{ url('arret/'.$arret->id) }}">Voir</a></td>
                                    <td>{{ $arret->designation }}</td>
                                    <td>{{ $rjn[$arret->volume_id] }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <p><a class="btn btn-sm btn-primary" href="{{ url('arret') }}">Tous</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4><i class="fa fa-edit"></i> &nbsp;Derniers Articles de doctrine</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Volume</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(!$articles->isEmpty())
                                @foreach($articles as $article)
                                    <tr>
                                        <td><a class="btn btn-sm btn-info" href="{{ url('article/'.$article->id) }}">Voir</a></td>
                                        <td>{{ $article->titre }}</td>
                                        <td>{{ $rjn[$article->volume_id] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <p><a class="btn btn-sm btn-primary" href="{{ url('article') }}">Tous</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4><i class="fa fa-edit"></i> &nbsp;Dernières Chroniques</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Titre</th>
                            <th>Volume</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(!$chroniques->isEmpty())
                                @foreach($chroniques as $chronique)
                                <tr>
                                    <td><a class="btn btn-sm btn-info" href="{{ url('chronique/'.$chronique->id) }}">Voir</a></td>
                                    <td>{{ $chronique->titre }}</td>
                                    <td>{{ $rjn[$chronique->volume_id] }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <p><a class="btn btn-sm btn-primary" href="{{ url('chronique') }}">Tous</a></p>
                </div>
            </div>
        </div>

    </div>

@stop