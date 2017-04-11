@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="options text-right" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
               <a href="{{ url('admin/loi/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-edit"></i> &nbsp;Loi</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="generic">
                        <thead>
                        <tr>
                            <th class="col-sm-1">Action</th>
                            <th class="col-sm-2">Sigle</th>
                            <th class="col-sm-4">Name</th>
                            <th class="col-sm-2">Liste</th>
                            <th class="col-sm-2">Domaine</th>
                            <th class="col-sm-1"></th>
                        </tr>
                        </thead>

                        <tbody class="selects">
                        <?php setlocale(LC_ALL, 'fr_FR.UTF-8'); ?>

                            @if(!empty($lois))
                                @foreach($lois as $loi)
                                    <tr>
                                        <td><a class="btn btn-sky btn-sm" href="{{ url('admin/loi/'.$loi->id) }}">éditer</a></td>
                                        <td><strong>{{ $loi->sigle }}</strong></td>
                                        <td>{{ $loi->name }}</td>
                                        <td><a class="btn btn-default btn-sm" href="{{ url('admin/disposition/loi/'.$loi->id) }}">Voir les contenus</a></td>
                                        <td>{{ $droit[$loi->droit] }}</td>
                                        <td>
                                            <form action="{{ url('admin/loi/'.$loi->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                                <button data-action="loi: {{ $loi->name }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="col-sm-1">Action</th>
                                <th class="col-sm-2">Sigle</th>
                                <th class="col-sm-4">Name</th>
                                <th class="col-sm-2">Liste</th>
                                <th class="col-sm-2">Droit</th>
                                <th class="col-sm-1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@stop