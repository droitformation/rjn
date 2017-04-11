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

                <form action="{{ url('admin/disposition/'.$disposition->id) }}" method="post" class="form-validation form-horizontal">
                    <input type="hidden" name="_method" value="PUT">{!! csrf_field() !!}

                <div class="panel-heading">
                    <h4>&Eacute;diter</h4>
                </div>
                <div class="panel-body event-info">

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Contenu</label>
                            <div class="col-sm-7">
                                {!! Form::textarea('content', $disposition->content , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Cotes</label>
                            <div class="col-sm-7">
                                {!! Form::text('cote', $disposition->cote , array('class' => 'form-control') ) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Subdivisions</label>
                            <div class="col-lg-2 col-sm-4 col-xs-6">
                                {!! Form::text('subdivision', $disposition->subdivision , array('class' => 'form-control') ) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label">Page</label>
                            <div class="col-lg-1 col-sm-2 col-xs-3">
                                {!! Form::text('page', $disposition->page , array('class' => 'form-control') ) !!}
                            </div>
                        </div>

                </div>
                <div class="panel-footer mini-footer ">
                    {!! Form::hidden('loi_id', $disposition->loi_id ) !!}
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