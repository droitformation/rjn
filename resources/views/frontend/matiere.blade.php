@extends('layouts.master')
@section('content')

    <div class="col-md-12">

        <h2>Matières</h2>

        @include('partials.search')

        <div id="main-content">

            <div class="row">
                <nav class="col-md-12 text-center">
                    <ul class="pagination">
                        @foreach($alpha as $lettre)
                            <li <?php echo ($current == $lettre ? 'class="active"' : ''); ?>>
                                <a href="{{ url('matiere/'.$lettre) }}">{{ $lettre }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            @if(!$matieres->isEmpty())
                <div class="note-list">
                    @foreach($matieres as $matiere)

                        <span class="anchored" id="{{ $matiere->slug }}"></span>
                        <h4><a href="#">{{ $matiere->title }}</a></h4>
                        <?php $pathmatiere = substr($matiere->title, 0, 1); ?>

                        @if(!$matiere->notes->isEmpty())
                            @foreach($matiere->notes as $note)

                                @if($note->exist_url)

                                    <div class="row">
                                        <div class="col-md-11">
                                            @if(!empty($note->confer_interne))

                                                @foreach($note->anchor as $anchor => $cf)
                                                    @if($cf)
                                                        <?php
                                                        $path   = strtoupper(substr($anchor, 0, 1));
                                                        $scroll = ($pathmatiere == $path ? 'data-scroll' : '');
                                                        ?>
                                                        <a class="anchor" {{ $scroll }} href="{{ url('matiere/'.$path.'#'.$anchor) }}">
                                                            <i class="glyphicon glyphicon-paperclip"></i> &nbsp;cf. {{ $cf }}
                                                        </a>
                                                    @endif
                                                @endforeach

                                            @endif

                                            @unless ($note->content == '')
                                                <p class="note-item">{{ ucfirst($note->content) }}</p>
                                            @endunless
                                        </div>
                                        <div class="col-md-1 text-right">
                                            @if(isset($note->note_pages))
                                                @foreach($note->note_pages as $pages)
                                                    @unless ($pages->page == 0)
                                                    <p><a class="btn btn-default btn-sm" href="{{ url('page/'.$pages->page.'/'.$pages->volume_id.'/matiere') }}">Voir</a></p>
                                                    @endunless
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                             @endforeach
                        @endif

                     @endforeach
                </div>
            @else
                <h5 class="text-danger">
                    <br/><i class="glyphicon glyphicon-exclamation-sign"></i> &nbsp;Aucune matière pour <strong>{{ $current }}</strong>
                </h5>
            @endif

            <div class="row">
                <nav class="col-md-12 text-center">
                    <ul class="pagination">
                        @foreach($alpha as $lettre)
                            <li <?php echo ($current == $lettre ? 'class="active"' : ''); ?>>
                                <a href="{{ url('matiere/'.$lettre) }}">{{ $lettre }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

        </div>
    </div>

@stop