@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="options text-right" style="margin-bottom: 10px;">
            <div class="btn-toolbar">
               <a href="{{ url('admin/domain/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp;Ajouter</a>
            </div>
        </div>

        <div class="panel panel-midnightblue">
            <div class="panel-heading">
                <h4><i class="fa fa-tasks"></i> &nbsp;Domaines</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0px;" id="generic">
                        <thead>
                        <tr>
                            <th class="col-sm-2">Action</th>
                            <th class="col-sm-7">Titre</th>
                            <th class="col-sm-3">Type de droit</th>
                            <th class="col-sm-2"></th>
                        </tr>
                        </thead>
                        <tbody class="selects">

                        @if(!empty($domains))
                            @foreach($domains as $domain)
                                <tr>
                                    <td><a class="btn btn-sky btn-sm" href="{{ url('admin/domain/'.$domain->id) }}">&Eacute;diter</a></td>
                                    <td><strong>{{ $domain->title }}</strong></td>
                                    <td><strong>{{ $droit[$domain->droit] }}</strong></td>
                                    <td class="text-right">
                                        <form action="{{ url('admin/domain/'.$domain->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">{!! csrf_field() !!}
                                            <button data-action="contenu: {{ $domain->title }}" class="btn btn-danger btn-sm deleteAction">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                        <tfoot>
                            <th class="col-sm-2">Action</th>
                            <th class="col-sm-7">Titre</th>
                            <th class="col-sm-3">Type de droit</th>
                            <th class="col-sm-2"></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@stop