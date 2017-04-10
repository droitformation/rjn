@extends('layouts.master')
@section('content')

<section class="row">
    <div class="col-sm-12">
        <h4>{{ $domain->title }}</h4>
    </div>
</section>

<?php
echo '<pre>';
//print_r($rjn);
echo '</pre>';
?>

<section class="row">
    <div class="col-sm-3">
        <div class="volume">
            @if(!$rjn->isEmpty())
                @foreach($rjn as $volume)
                <div class="volume-item">
                    <a href="{{ url('domain/volume/'.$volume->id) }}" class="current">
                        <i class="glyphicon glyphicon-book"></i> &nbsp;&nbsp;Volume {{ $volume->publication_at->year }}
                    </a>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-sm-9">
        <div class="clear">
            <div class="list-group bg-white">
                @if(isset($domain->categories) && !$domain->categories->isEmpty())
                    @foreach($domain->categories as $categorie)
                        <div class="list-group-item list-domain">
                            <h5><i class="fa fa-star"></i> &nbsp;{{ $categorie->title }}</h5>
                            <p><a href=""></a></p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

@stop
