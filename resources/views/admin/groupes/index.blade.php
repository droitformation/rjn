@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="options text-right" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
               <a href="{{ url('admin/groupe/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-tasks"></i> &nbsp;Groupes</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="generic">
                        <thead>
                        <tr>
                            <th class="col-sm-1">Action</th>
                            <th class="col-sm-3">Titre</th>
                            <th class="col-sm-5">Volume</th>
                            <th class="col-sm-2"></th>
                        </tr>
                        </thead>
                        <tbody class="selects">

                        @if(!empty($groupes))
                            @foreach($groupes as $groupe)
                                <tr>
                                    <td><a class="btn btn-sky btn-sm" href="{{ url('admin/groupe/'.$groupe->id) }}">&Eacute;diter</a></td>
                                    <td><strong>{{ $groupe->titre }}</strong></td>
                                    <td>{{ $rjn[$groupe->volume_id] }}</td>
                                    <td class="text-right">
                                        <form action="{{ url('admin/groupe/'.$groupe->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                            <button data-action="contenu: {{ $groupe->titre }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@stop