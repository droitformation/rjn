@extends('layouts.master')
@section('content')

<div class="col-md-12">

    <h2>Jurisprudence</h2>

    @include('partials.search')

    <div id="main-home">
        <div class="row">
            <div class="col-md-12">
                <div class="bloc-home">
                    @include('partials.domains')
                </div>
            </div>
        </div>
    </div>
</div>


@stop
