<div id="sidebar" class="col-md-4">
    <div class="bloc-home">

        <?php  $path = (isset($current_volume) && $current_volume ? '/'.$current_volume : '');  ?>
        @foreach($all_domains as $domain)
            <h5 class="titleList"><a href="{{ url('domain/'.$domain->id) }}"><strong>{{ $domain->title }}</strong></a></h5>
            @if(isset($domain->categories) && !$domain->categories->isEmpty())
                <ul class="nav nav-pills red nav-stacked">
                    @foreach($domain->categories as $categories)
                    <li class="<?php echo (isset($current_categorie) && $categories->id == $current_categorie ? 'active' : ''); ?>">
                        <a href="{{ url('categorie/'.$categories->id).$path }}">{{ $categories->title }}</a>
                    </li>
                    @endforeach
                </ul>
            @endif
        @endforeach

    </div>
</div>