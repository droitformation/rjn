@extends('layouts.master')
@section('content')

<div class="col-md-12">
    <div id="main-content">

    @if(!empty($arret))

            <div class="row">
                <div class="col-md-6">
                    <ul class="domain-list">
                        <li>
                            @if(isset($domains_jurisprudence[$arret->domain_id] ))
                                <a href="{{ url('domain/'.$arret->domain_id) }}">{{ $domains_jurisprudence[$arret->domain_id] }}</a>
                            @endif
                        </li>

                        @if(isset($arret->arrets_categories) && !$arret->arrets_categories->isEmpty())
                         <li> {{ $arret->arrets_categories[0]->title }}</li>
                        @endif

                    </ul>
                </div>
                <div class="col-md-6 text-right">

                    <?php
                        $path     = Session::get('path', null);
                        $lois     = ($path == 'lois' ? 'warning' : '');
                        $matiere  = ($path == 'matiere' ? 'warning' : '');
                        $href     = (!empty($path) ? $path : 'domain/'.$arret->domain_id);
                    ?>

                    <a class="btn btn-default btn-sm" href="{!! url($href) !!}">Retour à la liste</a>
                </div>
            </div>
            <div class="blog-post">
                <div class="post-item">
                    <div class="caption">

                        @if(!$critique->isEmpty())
                            <p><a class="btn btn-default btn-sm" href="#analyse">Voir l'analyse de l'arrêt</a></p>
                        @endif

                        <p><small><i class="glyphicon glyphicon-book"></i> &nbsp;RJN {{ $rjn->find($arret->volume_id)->publication_at->year }}</small></p>

                        <h3 class="post-title">{{ $arret->designation }}</h3>
                        <p class="{{ $lois }}"><strong>{{ $arret->cotes }}</strong></p>
                        <p><cite class="{{ $matiere }}">{{ $arret->sommaire }}</cite></p>

                        <div class="post-sum">
                            <div class="text-indent">{!! $arret->portee !!}</div>
                            <div>{!! $arret->faits !!}</div>
                            <div id="considerant">
                                <p><strong>Considérant</strong></p>
                                {!! $arret->considerant !!}
                            </div>
                            <div>{!! $arret->droit !!}</div>
                            <div>{!! $arret->conclusion !!}</div>
                            <hr/>
                            @if(!empty($arret->note))
                                <p>Note: <cite>{{ $arret->note }}</cite></p>
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