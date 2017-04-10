@extends('layouts.master')
@section('content')

<div class="col-md-12">

    <h2>Doctrine</h2>

    @include('partials.search')

    <div id="main-content">

    <?php  $roman = new \App\Droit\Helper\RomanNumeralsConverter();  ?>

    <section class="row">

        <div id="doctrine" class="col-sm-12">
            @if(isset($doctrines))
                <h4><strong>Articles de doctrine</strong></h4>
                @foreach($doctrines as $doctrine)
                    <div class="row">
                        <div class="col-md-2">
                            <p><small><i class="glyphicon glyphicon-book"></i> &nbsp;RJN {{ $rjn->find($doctrine->volume_id)->publication_at->year }}</small></p>
                        </div>
                        <div class="col-md-9">
                            <p><a href="{{ url('article/'.$doctrine->id) }}">{{ $doctrine->titre }}</a></p>
                        </div>
                        <div class="col-md-1">
                            <a class="btn btn-sm btn-default pull-right" href="{{ url('article/'.$doctrine->id) }}">Voir</a>
                        </div>
                    </div>
                @endforeach
            @endif

            @if(isset($chroniques) && !empty($chroniques))
                <h4><strong>Chroniques de Jurisprudence</strong></h4>

                    @foreach($chroniques as $domain_id => $chron)

                        <h4>{{ $domains_doctrine[$domain_id] }}</h4>

                        @foreach($chron as $annee => $annees)
                            <div class="row">
                                <div class="col-md-12">
                                    <p><small><i class="glyphicon glyphicon-book"></i> &nbsp;RJN {{ $rjn->find($annee)->publication_at->year }}</small></p>
                                </div>
                            </div>
                            @foreach($annees as $chronique)
                            <div class="row">
                                <div class="col-md-11">
                                    <p><a href="{{ url('chronique/'.$chronique->id) }}">{{ $chronique->titre }}</a></p>
                                </div>
                                <div class="col-md-1">
                                    <a class="btn btn-sm btn-default pull-right" href="{{ url('chronique/'.$chronique->id) }}">Voir</a>
                                </div>
                            </div>
                            @endforeach
                         @endforeach
                    @endforeach
                </ul>
            @endif

        </div>
    </section>

    </div>
</div>

@stop
