@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/disposition/loi/'.$loi_id) }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/disposition') }}" method="post" class="form-validation form-horizontal">
                {!! csrf_field() !!}

            <div class="panel-heading">
                <h4>Ajouter un contenu</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Contenu</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('content', '' , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Cotes</label>
                    <div class="col-sm-7">
                        {!! Form::text('cote', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Subdivisions</label>
                    <div class="col-lg-2 col-sm-4 col-xs-6">
                        {!! Form::text('subdivision', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Page</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::text('page', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {!! Form::hidden('loi_id', $loi_id ) !!}
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