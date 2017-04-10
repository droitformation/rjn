@extends('layouts.master')
@section('content')

<div class="col-md-12">
    <h2>Contact</h2>

    <div id="main-content">

        <div class="row">
            <div class="col-md-4 col-sx-12">
                <address>
                    <h4><strong>Faculté de droit</strong></h4>
                    Avenue du 1er-Mars 26<br>
                    2000 Neuchâtel<br>
                    Tél. +41 32 / 718 12 22
                </address>

                <address>
                    <strong>Email</strong><br>
                    <a href="mailto:droit.formation@unine.ch">droit.formation@unine.ch</a>
                </address>
            </div><!--END ONE-HALF-->

            <div class="col-md-8 col-sx-12">

                <!-- form start -->

                <form method="post" action="{{ url('sendMessage') }}" class="form-horizontal form-validation">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nom</label>
                        <div class="col-sm-10">
                            <input class="form-control" required name="nom" type="text" id="nom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" required name="email" type="email" id="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea name="remarque" id="remarque" rows="12" class="form-control required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input value="Envoyer" class="btn btn-danger" type="submit" />
                        </div>
                    </div>

                </form>
            </div><!--END ONE-HALF LAST-->
        </div><!--END row-->

    </div><!--END main content-->
</div><!--END row-->

@stop
