@extends('layouts.admin')
@section('content')

<!-- row -->
    <div class="row">
        <div class="col-md-6">

            <form action="{{ url('admin/search') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Recherche</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                            <input class="form-control" name="search" type="text">
                            <div class="input-group-btn">
                                <button class="btn btn-info" type="submit">Go!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-6">
            <div class="alert alert-dismissable alert-warning">
                <i class="fa fa-info-circle"></i>
                Recherche avec multiples mots entre guillemets
            </div>
        </div>
    </div>
<!-- end row -->
<hr/>
<!-- Start row -->
<div class="row">
  <div class="col-md-12">
        <div class="panel panel-gray">

            @if(!empty($arrets))
            <div class="panel-heading">
                <h4><i class="fa fa-search icon-highlight icon-highlight-primary"></i> &nbsp;Résultats pour « <?php echo $search; ?> » dans arrêts</h4>
            </div>

            <div class="panel-body collapse in">
                <table class="table" style="margin-bottom: 0px;" id="arrets">
                    <thead>
                    <tr>
                        <th class="col-sm-2">Action</th>
                        <th class="col-sm-2">Référence</th>
                        <th class="col-sm-2">Date de publication</th>
                        <th class="col-sm-6">Résumé</th>
                    </tr>
                    </thead>
                    <tbody class="selects">

                        @foreach($arrets as $arret)
                            <tr>
                                <td><a class="btn btn-sky btn-sm" href="{{ url('admin/arret/'.$arret->id) }}">éditer</a></td>
                                <td><strong>{{ $arret->reference }}</strong></td>
                                <td>{{ $arret->pub_date->formatLocalized('%d %B %Y') }}</td>
                                <td>{{ $arret->abstract }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="col-sm-2">Action</th>
                        <th class="col-sm-2">Référence</th>
                        <th class="col-sm-2">Date de publication</th>
                        <th class="col-sm-6">Résumé</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

            @else

            <div class="panel-heading">
                <h4><i class="fa fa-search icon-highlight icon-highlight-primary"></i> &nbsp;Recherche</h4>
            </div>
            <div class="panel-body collapse in">
                <p>Aucune correspondance trouvé</p>
            </div>

            @endif

        </div>
    </div>
</div>
<!-- end row -->


@stop