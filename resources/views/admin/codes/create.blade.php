@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/code') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            {!! Form::open(['method' => 'POST', 'class' => 'form-validation form-horizontal','url' => ['admin/code']]) !!}

            <form action="{{ url('admin/code') }}" method="post" class="form-validation form-horizontal">
               {!! csrf_field() !!}

            <div class="panel-heading">
                <h4>Ajouter un code</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Code</label>
                    <div class="col-lg-2 col-sm-4 col-xs-12">
                        {!! Form::text('code', old('code') , ['class' => 'form-control'] ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Valide jusqu'au</label>
                    <div class="col-lg-2 col-sm-4 col-xs-8">
                        {!! Form::text('valid_at', old('valid_at') , ['class' => 'form-control datePicker'] ) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                </div>
            </div>

            </form>
        </div>
    </div>


</div>
<!-- end row -->

@stop