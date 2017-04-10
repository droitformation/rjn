@extends('layouts.master')
@section('content')

<div class="col-md-12">

    <h2>Lois</h2>

    @include('partials.search')

    <div id="main-content">

        @if(!empty($lois))
        <div class="lois-list">
            @foreach($lois as $name => $droit)
            <?php  $tribunaux = [1 => 'Droit Fédéral' , 2 => 'Droit Cantonal' , 3 => 'Accords Internationaux'];  ?>
            <h4>{{ $tribunaux[$name] }}</h4>
            @foreach($droit as $loi)

            <div class="row">
                <div class="col-md-2">
                    <h5>{{ $loi->sigle }}</h5>
                </div>
                <div class="col-md-9">
                    <p class="text-muted"><small>{{ $loi->name }}</small></p>
                </div>
                <div class="col-md-1">
                    <p><a class="btn btn-sm btn-default" href="{{ url('disposition/'.$loi->id) }}">Voir</a></p>
                </div>
            </div>

            @endforeach
            @endforeach
        </div>
        @endif

    </div>
</div>


@stop