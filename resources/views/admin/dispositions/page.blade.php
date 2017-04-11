@extends('layouts.admin')
@section('content')

@if (!empty($disposition) )

    <div class="row"><!-- row -->
        <div class="col-md-12"><!-- col -->
            <p><a class="btn btn-default" href="{{ url('admin/disposition/loi/'.$disposition->loi_id ) }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
        </div>
    </div>
    <!-- start row -->
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-midnightblue">

                <form action="{{ url('admin/disposition/addpage') }}" method="post" class="form-validation form-horizontal">
                   {!! csrf_field() !!}

                <div class="panel-heading">
                    <h4>Subdivisions de la disposition</h4>
                </div>
                <div class="panel-body event-info">
                    @if(!$disposition->disposition_pages->isEmpty())
                        <div class="row">
                            <h4 class="col-md-3 col-md-offset-2 control-label"><p>Subdivision existantes pour l'article</p></h4>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-xs-0"></label>
                            <p class="col-lg-1 col-sm-2">Alinea</p>
                            <p class="col-lg-1 col-sm-2">Lettre</p>
                            <p class="col-lg-1 col-sm-2">Chiffre</p>
                            <p class="col-lg-1 col-sm-2">Page</p>
                            <p class="col-lg-1 col-sm-2">Volume</p>
                        </div>
                        @foreach($disposition->disposition_pages as $page)

                            <div class="form-group">
                                <label for="message" class="col-sm-3 col-xs-12 control-label">{{ $disposition->cote }}</label>
                                <div class="col-lg-1 col-sm-2 col-xs-2">
                                    {!! Form::text('sub[alinea][]', $page->alinea , array('class' => 'form-control', 'placeholder' => 'alinea') ) !!}
                                </div>
                                <div class="col-lg-1 col-sm-2 col-xs-2">
                                    {!! Form::text('sub[lettre][]', $page->lettre , array('class' => 'form-control', 'placeholder' => 'lettre') ) !!}
                                </div>
                                <div class="col-lg-1 col-sm-2 col-xs-2">
                                    {!! Form::text('sub[chiffre][]', $page->chiffre , array('class' => 'form-control','placeholder' => 'chiffre') ) !!}
                                </div>
                                <div class="col-lg-1 col-sm-2 col-xs-2">
                                    {!! Form::text('sub[page][]', $page->page , array('class' => 'form-control', 'placeholder' => 'page') ) !!}
                                </div>
                                <div class="col-lg-1 col-sm-2 col-xs-2">
                                    {!! Form::select('sub[volume_id][]', array('' => 'Choisir') + $rjn , $page->volume_id, [ 'class' => 'form-control', 'placeholder' => 'volume']) !!}
                                </div>
                            </div>

                        @endforeach
                    @endif

                    <div class="row">
                        <h4 class="col-md-3 col-md-offset-2 control-label"><p>Ajouter une subdivision pour l'article</p></h4>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-xs-0"></label>
                        <p class="col-lg-1 col-sm-2">Alinea</p>
                        <p class="col-lg-1 col-sm-2">Lettre</p>
                        <p class="col-lg-1 col-sm-2">Chiffre</p>
                        <p class="col-lg-1 col-sm-2">Page</p>
                        <p class="col-lg-1 col-sm-2">Volume</p>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-sm-3 col-xs-12 control-label">{{ $disposition->cote }}</label>
                        <div class="col-lg-1 col-sm-2 col-xs-2">
                            {!! Form::text('sub[alinea][]', null , array('class' => 'form-control', 'placeholder' => 'alinea') ) !!}
                        </div>
                        <div class="col-lg-1 col-sm-2 col-xs-2">
                            {!! Form::text('sub[lettre][]', null , array('class' => 'form-control', 'placeholder' => 'lettre') ) !!}
                        </div>
                        <div class="col-lg-1 col-sm-2 col-xs-2">
                            {!! Form::text('sub[chiffre][]', null , array('class' => 'form-control','placeholder' => 'chiffre') ) !!}
                        </div>
                        <div class="col-lg-1 col-sm-2 col-xs-2">
                            {!! Form::text('sub[page][]', null , array('class' => 'form-control', 'placeholder' => 'page') ) !!}
                        </div>
                        <div class="col-lg-1 col-sm-2 col-xs-2">
                            {!! Form::select('sub[volume_id][]', array('' => 'Choisir') + $rjn , null, [ 'class' => 'form-control', 'placeholder' => 'volume']) !!}
                        </div>
                    </div>

                </div>
                <div class="panel-footer mini-footer ">
                    {!! Form::hidden('id', $disposition->id ) !!}
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary" type="submit">Envoyer </button>
                    </div>
                </div>
               </form>
            </div>
        </div>
    </div>
    <!-- end row -->
@endif

@stop