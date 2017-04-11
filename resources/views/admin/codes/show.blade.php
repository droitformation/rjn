@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/code') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    @if(!empty($code))

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/code/'.$code->id) }}" method="post" class="form-validation form-horizontal">
            <input type="hidden" name="_method" value="PUT">{!! csrf_field() !!}

            <div class="panel-heading">
                <h4>&Eacute;diter</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Code</label>
                    <div class="col-lg-7 col-sm-7 col-xs-12">
                        {!! $code->used ? '<span class="label label-warning">utilisé</span>' : '<span class="label label-info">pas utilisé</span>' !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Code</label>
                    <div class="col-lg-2 col-sm-4 col-xs-12">
                        {!! Form::text('code', $code->code , ['class' => 'form-control'] ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Valide jusqu'au</label>
                    <div class="col-lg-2 col-sm-2 col-xs-8">
                        {!! Form::text('valid_at', $code->valid_at->format('Y-m-d') , ['class' => 'form-control datePicker'] ) !!}
                    </div>
                </div>

                @if($code->user_id)
                    <div class="form-group">
                        <label for="message" class="col-sm-3 control-label">Utilisé par</label>
                        <div class="col-lg-2 col-sm-4 col-xs-8">
                           <input type="text" class="form-control" value="{{ $code->user->name }}" disabled>
                        </div>
                    </div>
                @endif

            </div>
            <div class="panel-footer mini-footer ">
                <div class="col-sm-3">{!! Form::hidden('id', $code->id ) !!}</div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </div>
           </form>
        </div>
    </div>

    @endif

</div>
<!-- end row -->

@stop