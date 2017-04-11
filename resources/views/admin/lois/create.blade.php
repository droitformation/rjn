@extends('layouts.admin')
@section('content')

<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/loi') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>

<!-- start row -->
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-midnightblue">

            <form action="{{ url('admin/loi') }}" method="post" class="form-validation form-horizontal">
                {!! csrf_field() !!}

            <div class="panel-heading">
                <h4>Créer loi</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Nom</label>
                    <div class="col-sm-7">
                        {!! Form::textarea('name', '' , array('class' => 'form-control', 'cols' => '50' , 'rows' => '4' )) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Sigle</label>
                    <div class="col-lg-1 col-sm-2 col-xs-3">
                        {!! Form::text('sigle', '' , array('class' => 'form-control') ) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Domaine</label>
                    <div class="col-lg-2 col-sm-3 col-xs-7">
                        <select class="form-control" name="droit">
                            @if(!empty($droit))
                                @foreach($droit as $droit_id => $droit_nom)
                                    <option value="{{ $droit_id }}">{{ $droit_nom }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer </button>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
<!-- end row -->

@stop