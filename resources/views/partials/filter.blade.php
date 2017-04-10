<h4>Domaine</h4>
{!! Form::open(array('id' => 'filterSelect', 'url' => 'filter' )) !!}
    <select style="width: 100%;" name="domain_id" data-placeholder="Domaine" class="chosen-select">
        @if(!empty($domains_jurisprudence))
            @foreach($domains_jurisprudence as $id => $dom)
            <option <?php echo ($domain->id == $id ? 'selected' : ''); ?> value="{{ $id }}">{{ $dom }}</option>
            @endforeach
        @endif
    </select>
    <input type="hidden" name="volume_id" value="{{ $current }}">
{!! Form::close() !!}