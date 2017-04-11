@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="options text-right" style="margin-bottom: 10px;">
                <div class="btn-toolbar">
                    <a href="{{ url('admin/matiere/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
                </div>
            </div>
            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4><i class="fa fa-tag"></i> &nbsp;Matières</h4>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table" style="margin-bottom: 0px;" id="generic">
                            <thead>
                            <tr>
                                <th class="col-sm-1">Action</th>
                                <th class="col-sm-4">Titre</th>
                                <th class="col-sm-4">Liste</th>
                                <th class="col-sm-1"></th>
                            </tr>
                            </thead>
                            <tbody class="selects">

                                @if(!empty($matieres))
                                    @foreach($matieres as $matiere)

                                        <tr>
                                            <td><a class="btn btn-sky btn-sm" href="{{ url('admin/matiere/'.$matiere->id) }}">&Eacute;diter</a></td>
                                            <td><strong>{!! $matiere->title !!}</strong></td>
                                            <td><a class="btn btn-default btn-sm" href="{{ url('admin/note/matiere/'.$matiere->id) }}">Voir les contenus</a></td>
                                            <td class="text-right">
                                                <form action="{{ url('admin/matiere/'.$matiere->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                                    <button data-action="contenu: {{ $matiere->titre }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="col-sm-1">Action</th>
                                    <th class="col-sm-4">Titre</th>
                                    <th class="col-sm-4">Liste</th>
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