@extends('layouts.master')
@section('content')

<div class="col-md-12">
    <div id="main-content">

        @if(!empty($article))

            <div class="blog-post">
                <div class="post-item">
                    <div class="caption">

                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="post-title">{{ $article->titre }}</h2>
                            </div>
                            <div class="col-md-2">
                                <p class="pull-right"><a class="btn btn-default btn-sm" href="{!! url('doctrine/'.$article->volume_id) !!}">Retour à la liste</a></p>
                            </div>
                        </div>

                        @if(!$critique->isEmpty())
                            <p><a class="btn btn-default btn-sm" href="#analyse">Voir l'analyse de l'article</a></p>
                        @endif

                        @if(!$article->doctrine_author->isEmpty())
                            <p>Par</p>
                            <p class="lead auteurs-list">
                            @foreach($article->doctrine_author as $author)
                                <cite>{{ $author->first_name }} {{ $author->last_name }} <small>{{ $author->occupation }}</small></cite>
                            @endforeach
                            </p>
                        @endif
                        <div class="post-sum">
                            <div id="article">{!! $article->article !!}</div>
                            <hr/>
                            <h4><strong>Bibliographie</strong></h4>
                            <div>{!! $article->bibliographie !!}</div>

                            @if($article->citations)
                                <div id="citations" class="hide">
                                    {!! $article->citations !!}
                                </div>
                            @endif

                            @if(!empty($article->notes))
                                <hr/>
                                <p>Note: <cite>{{ $article->notes }}</cite></p>
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