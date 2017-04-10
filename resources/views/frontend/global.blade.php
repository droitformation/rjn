@extends('layouts.master')
@section('content')

<div class="col-md-12">
    <div id="main-content">

        <section class="row">
            <div class="col-sm-12">

                @if(!empty($results))

                    @foreach($results as $search)
                        <div class="arrets-list">
                            <h3>Recherche: <strong>{{ $search['terms'] }}</strong> dans <strong>{{ $content }}</strong></h3><br/>

                            @if( (is_array($search['result']) && !empty($search['result'])) || !$search['result']->isEmpty() )
                                @if(array_key_exists('doctrine', $search['result']))

                                    @if(!$search['result']['doctrine']->isEmpty())
                                        <h4>Doctrine</h4>
                                        @include('partials.result', ['arrets' => $search['result']['doctrine']])
                                    @else
                                        <p class="text-danger">
                                            <i class="glyphicon glyphicon-exclamation-sign"></i> &nbsp;Aucun résultat dans la doctrine
                                        </p>
                                    @endif

                                    @if(!$search['result']['chronique']->isEmpty())
                                        <h4>Chroniques</h4>
                                        @include('partials.result', ['arrets' => $search['result']['chronique'], 'type' => 'chronique'] )
                                    @else
                                    <p class="text-danger">
                                        <i class="glyphicon glyphicon-exclamation-sign"></i> &nbsp;Aucun résultat dans les chroniques de jurisprudence
                                    </p>
                                    @endif

                                @else
                                    @include('partials.result', ['arrets' => $search['result'] ])
                                @endif

                            @else
                                <p class="text-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> &nbsp;Aucun résultat pour cette recherche</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> &nbsp;Aucun résultat pour cette recherche</p>
                @endif
            </div>
        </section>

    </div>
</div>

@stop
