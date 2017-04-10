@extends('layouts.master')
@section('content')

<div class="col-md-12">

    <h2>Jurisprudence</h2>

    @include('partials.search')
</div>

<div class="col-md-8">
    <div id="main-content">

        @include('partials.header-arrets')

        <section class="row">
            <div class="col-sm-12">

                <?php $all = ($section['url'] == 'categorie' ? $all_categories : $domains_jurisprudence); ?>
                <h3>{{ $all[$current_id] }}</h3>

                @include('partials.arrets')

            </div>
        </section>

    </div>
</div>

<!-- START partials -->
@include('partials.sidebar')
<!-- END partials -->

@stop
