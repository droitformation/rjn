@extends('layouts.master')
@section('content')

<div class="col-md-12">
    <div id="main-content">

        @if(!empty($chronique))
            <div class="row">
                <div class="col-md-12">
                    <p class="pull-right"><a class="btn btn-default btn-sm" href="{!! url('doctrine/'.$chronique->volume_id) !!}">Retour à la liste</a></p>
                </div>
            </div>
            <div class="blog-post">
                <div class="post-item">
                    <div class="caption">

                        @if(!$critique->isEmpty())
                        <p><a class="btn btn-default btn-sm" href="#analyse">Voir l'analyse de la chronique</a></p>
                        @endif

                        <h4>{{ $domains_doctrine[$chronique->domain_id] }}</h4>
                        @if(!$chronique->author_chronique->isEmpty())
                        <p>Par</p>
                        <p class="lead auteurs-list">
                            @foreach($chronique->author_chronique as $author)
                                <cite>{{ $author->first_name }} {{ $author->last_name }} <small>{{ $author->occupation }}</small></cite>
                            @endforeach
                        </p>
                        @endif
                        <h3 class="post-title">{{ $alpha[$chronique->sorting - 1] }}. {{ $chronique->titre }}</h3>
                        <div class="post-sum">
                            <div id="article">
                                <h4><cite>1. Faits</cite></h4>
                                {!! $chronique->faits !!}
                                <h4><cite>2. Commentaires</cite></h4>
                                {!! $chronique->commentaires !!}
                            </div>
                            @if(!empty($chronique->citations))
                                <div id="citations" class="hide">
                                    {!! $chronique->citations or '' !!}
                                </div>
                            @endif

                            @if(!$critique->isEmpty())
                            <div class="well">
                                @foreach($critique as $crit)
                                <h4><a name="analyse">{{ $crit->titre }}</a></h4>
                                <p>
                                    <cite><strong>{{ $crit->author->first_name }} {{ $crit->author->last_name }}</strong></cite><br/>
                                    <cite class="text-muted">{{ $crit->author->occupation }}</cite>
                                </p>
                                <div>{!! $crit->contenu !!}</div>
                                @endforeach
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
</div>

@stop