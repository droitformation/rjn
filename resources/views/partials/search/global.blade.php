<form class="form-inline" role="form" method="POST" action="{{ url('terms') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="content" value="{{ $content }}">
    <div class="form-group col-md-9 col-search col-small-input">
        <input type="text" class="form-control search_input" name="terms" placeholder="Mots clés">
    </div>
    <button type="submit" class="btn btn-danger">OK</button>
</form>