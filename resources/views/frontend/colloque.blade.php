@extends('layouts.master')
@section('content')

<div class="col-md-12">

    <h2>Colloques</h2>

    <div id="main-content">
        <!-- Contenu -->

        <div class="blog-post">
            <div class="post-item">
                <div class="caption">

                    <h3>&Eacute;venements à venir</h3>
                    @if(!$colloques->isEmpty())

                        @foreach($colloques as $year => $colloque)
                            <div class="post-sum">
                                <?php
                                    setlocale(LC_ALL, 'fr_FR.UTF-8');
                                $date  = \Carbon\Carbon::parse($colloque['event']['start_at']);
                                $delai = \Carbon\Carbon::parse($colloque['event']['registration_at']);
                                ?>

                                <div class="post-data">
                                    <i class="fa fa-clock-o icon-muted"></i>&nbsp; {{ $date->formatLocalized('%d %B %Y') }}
                                </div>

                                <h3>
                                    <a target="_blank" href="{{ $colloque['url'] }}">{{ $colloque['event']['titre'] }}<br/>
                                        <strong>{{ $colloque['event']['soustitre'] }}</strong>
                                    </a>
                                </h3>

                                @if(isset($colloque['programme']))
                                    <p> <a target="_blank" href="{{ $colloque['programme'] }}">
                                        &nbsp;<i class="fa fa-file-o"></i> &nbsp;&nbsp;Le programme
                                    </a></p>
                                @endif

                                <dl class="dl-horizontal">
                                    <dt>Lieu:</dt>
                                    <dd>{{ $colloque['location'] }}</dd>
                                    <dt>Date:</dt>
                                    <dd>{{ $date->format('d/m/y') }}</dd>
                                    <dt>Délai d'inscription:</dt>
                                    <dd>{{ $delai->format('d/m/y') }}</dd>

                                    <dt>Prix d'inscription:</dt>
                                    @if(!empty($colloque['prix']))
                                        @foreach($colloque['prix'] as $prix)
                                            <dd>{{ $prix['description'] }} <strong>CHF {{ $prix['price']/100 }}</strong></dd>
                                        @endforeach
                                    @endif
                                </dl>
                                <p><a target="_blank" href="{{  $colloque['url'] }}" class="button small grey">Inscription</a></p>                            </div>
                         @endforeach
                    @else
                        <p>Encore aucun évenements à venir.</p>
                    @endif

                    <hr/>

                    @if(!$archives->isEmpty())
                        <h3>Archives</h3>
                        @foreach($archives as $colloque)
                            <p>
                                <?php setlocale(LC_ALL, 'fr_FR.UTF-8'); ?>
                                <?php $date  = \Carbon\Carbon::parse($colloque['event']['start_at']); ?>

                                <a target="_blank" href="{{ $colloque['url'] }}">
                                    <i class="glyphicon glyphicon-inbox"></i> &nbsp;{{ $colloque['event']['titre'] }}
                                </a>
                                | <small>{{ $date->formatLocalized('%d %B %Y') }}</small>
                            </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Fin contenu -->
    </div>
</div>

@stop