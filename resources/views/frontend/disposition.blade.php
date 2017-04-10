@extends('layouts.master')
@section('content')

<?php $helper = new \App\Droit\Helper\Helper; ?>

<div class="col-md-12">
    <div id="main-content">

    @if(!empty($dispositions))

        <div class="well row bottomMarg">
            <div class="col-md-2">
                <h3 class="sigle">{{ $dispositions->first()->loi->sigle}}</h3>
            </div>
            <div class="col-md-9">
                <p class="sigle-text">{{ $dispositions->first()->loi->name }}</p>
            </div>
            <div class="col-md-1">
            </div>
        </div>

        <div class="note-list">

            @foreach($dispositions as $dispo)
                @if($dispo->page_exist)
                <div class="row sigle">
                    <div class="col-md-8">
                        <p class="note-item">
                            <?php
                                $pattern = '/<[^\/>]*>([\s]?)*<\/[^>]*>/';
                                $string  = preg_replace($pattern, '', $dispo->content);
                            ?>
                            {{ ucfirst($string) }}
                        </p>
                    </div>
                    <div class="col-md-4">
                        @if(isset($dispo->disposition_pages))
                        <div class="row">
                            <div class="col-md-8">
                                <?php $i = 1; $links = ''; ?>
                                @foreach($dispo->disposition_pages as $pages)
                                    <strong class="lineHeight">{{ $dispo->cote }}
                                        <?php echo (!empty($pages->alinea)  ? 'al. '.$pages->alinea : ''); ?>
                                        <?php echo (!empty($pages->lettre)  ? 'let. '.$pages->lettre : ''); ?>
                                        <?php echo (!empty($pages->chiffre) ? 'ch. '.$pages->chiffre : ''); ?>
                                    </strong>
                                    <?php $count = count($dispo->disposition_pages); ?>
                                    <?php if( $count > 1 && $i < $count){ echo ';'; } ?>
                                    <?php $i++; ?>
                                @endforeach
                            </div>
                            <div class="col-md-4">
                                <p><a class="btn btn-default btn-sm" href="{{ url('page/'.$dispo->page.'/'.$dispo->volume_id.'/lois') }}">Voir</a></p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @endif

    </div>
</div>

@stop