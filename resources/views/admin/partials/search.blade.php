<li id="search">
    <a href="javascript:;"><i class="fa fa-search opacity-control"></i></a>
    {{ Form::open(array( 'url' => 'admin/search' )) }}
    <input type="text" class="search-query" name="search" placeholder="Recherche...">
    <button type="submit"><i class="fa fa-search"></i></button>
    {{ Form::close() }}
</li>