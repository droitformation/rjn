@extends('layouts.master')
@section('content')

<div class="col-md-12">

    @include('partials.search')

    <div id="main-content">

        @if($arrets)

        <div class="arrets-list">
            <h3>
                Recherche:

                @if(!empty($terms))
                    @foreach($terms as $type => $term)
                        <strong>{{ ($type == 'loi' && isset($list_lois[$term]) ? $list_lois[$term] : $type.' '.$term) }}</strong>
                    @endforeach
                @endif

                dans <strong>Jurisprudence</strong>
            </h3>
            <br/>
            @foreach($arrets as $arret)
            <div class="arrets-list-item row">
                <div class="col-md-8">
                    <a href="{{ url('arret/'.$arret->id) }}">{{ $arret->designation }}</a>
                    <p><strong>{{ $arret->cotes }}</strong></p>
                    <p class="text-muted">{!! $arret->sommaire !!}</p>
                    <p><em>{!! $arret->portee !!}</em></p>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('arret/'.$arret->id) }}">
                        page {{ $arret->page }}, Volume {{ $rjn->find($arret->volume_id)->publication_at->year }}
                    </a>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-sm btn-default" href="{{ url('arret/'.urlencode($arret->id)) }}">Voir</a>
                </div>
            </div>
            @endforeach
        </div>

        @else
            <h3>Recherche: <strong>{{ $searchterms }}</strong></h3><br/>
            <p class="text-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> &nbsp;Aucun résultat pour cette recherche</p>
        @endif

    </div>
</div>

@stop
