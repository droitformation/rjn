<form class="form-inline" role="form" method="POST" action="{{ url('search') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-md-4 col-xs-5 col-search-md">
        <select data-placeholder="Loi" class="selectpicker" id="select_loi" name="loi">
            @if(!empty($search_lois))
                @foreach($search_lois as $droit => $lois)
                    <?php
                    $thedroit = [1 => 'Droit fédéral', 2 => 'Droit cantonal', 3 => 'Droit internationnal'];
                    $domain = (isset($thedroit[$droit]) ? $thedroit[$droit] : $thedroit[$droit]);
                    ?>
                    <optgroup label="{{ $domain }}">
                        @foreach($lois as $loi)
                            <option value="{{ $loi->id }}">{{ $loi->sigle }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group col-md-2 col-small col-search">
        <input type="text" class="form-control search_input" name="article" id="select_article" placeholder="Article">
    </div>
    <div class="form-group col-md-2 col-small col-search">
        <input type="text" class="form-control search_input" name="alinea" id="select_alinea" placeholder="Alinéa">
    </div>
    <div class="form-group col-md-2 col-small col-search">
        <input type="text" class="form-control search_input" name="lettre" id="select_lettre" placeholder="Lettre">
    </div>
    <div class="form-group col-md-2 col-small col-search">
        <input type="text" class="form-control search_input" name="chiffre" id="select_chiffre" placeholder="Chiffre">
    </div>
    <button type="submit" class="btn btn-danger">OK</button>
</form>
