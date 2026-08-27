@extends('layouts.admin')

@section('content')
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>--}}
<div id="page_content_inner">

    <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium " data-uk-grid-margin>
        <div>
            <a style="display: block;" class="box-compte" href="#">
                <div class="md-card md-card-hover">
                    <div class="md-card-content">
                        {{--@if(isset($filtres['date_fin']) && $filtres['date_fin'] != \Carbon\Carbon::now()->endOfDay())--}}
                            <span class="uk-text-muted">Le nombre d'utilisateur : </span>
                       {{-- @else--}}
                           {{-- <span class="uk-text-muted">Montant total des ventes depuis le {{ $filtres['date_debut']->format('d/m/Y') }} : </span>--}}
                       {{-- @endif--}}

                        <h2 class="uk-margin-remove">
                            <span class="countUpMe">{{ count($users)}}</span>
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        {{--@if(isset($today) && $today == 1)--}}
            <div>
                <a style="display: block;" class="box-compte" href="#">
                    <div class="md-card md-card-hover">
                        <div class="md-card-content">
                            <span class="uk-text-muted">Le nombre de Proprietaire : </span>
                            <h2 class="uk-margin-remove">
                                <span class="countUpMe">{{ count($pro) ?? 0 }}</span>
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
            <div>
                <a style="display: block;" class="box-compte" href="#">
                    <div class="md-card md-card-hover">
                        <div class="md-card-content">
                            <span class="uk-text-muted">Encaissements de la journée : </span>
                            <h2 class="uk-margin-remove">
                                <span class="countUpMe">{{ $encaisses_today ?? 0 }} FCFA</span>
                            </h2>
                        </div>
                    </div>
                </a>
            </div>
        {{--@endif--}}
        <div>
            <a style="display: block;" class="box-compte" href="#">
                <div class="md-card md-card-hover">
                    <div class="md-card-content">
                       {{-- @if(isset($filtres['date_fin']) && $filtres['date_fin'] != \Carbon\Carbon::now()->endOfDay())--}}
                            <span class="uk-text-muted">le nombre de Locataire : </span>
                      {{--  @else
                            <span class="uk-text-muted">Montants dûs depuis le {{ $filtres['date_debut']->format('d/m/Y') }} : </span>
                        @endif--}}
                        <h2 class="uk-margin-remove">
                            <span class="countUpMe">{{ count($loc) ?? 0 }}</span>
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a style="display: block;" class="box-compte" href="#">
                <div class="md-card md-card-hover">
                    <div class="md-card-content">
                        <span class="uk-text-muted">CHIFFRE D'AFFAIRE : </span>
                        <h2 class="uk-margin-remove">
                            <span class="countUpMe">{{ $total->ca ?? 0 }} FCFA</span>
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a style="display: block;" class="box-compte" href="#">
                <div class="md-card md-card-hover">
                    <div class="md-card-content">
                        <span class="uk-text-muted">Le nombre de bien : </span>
                        <h2 class="uk-margin-remove">
                            <span class="countUpMe">{{ count($bien) ?? 0 }}</span>
                        </h2>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection
@section('scripts')

    <script src="{{ asset('dist/bower_components/countUp.js/dist/countUp.min.js') }}"></script>

    <script>
        $(window).on('load',function(){
            countUp();
        });
        function countUp() {
            $('.countUpMe').each(function () {
                var target = this,
                        countTo = $(target).text();
                theAnimation = new CountUp(target, 0, countTo, 0, 2);
                theAnimation.start();
            });
        }

        var $dp_start = $('#uk_dp_start'),
                $dp_end = $('#uk_dp_end');

        var start_date = UIkit.datepicker($dp_start, {
            format:'DD/MM/YYYY'
        });

        var end_date = UIkit.datepicker($dp_end, {
            format:'DD/MM/YYYY'
        });

        $dp_start.on('change',function() {
            end_date.options.minDate = $dp_start.val();
            setTimeout(function() {
                $dp_end.focus();
            },300);
        });

        $dp_end.on('change',function() {
            start_date.options.maxDate = $dp_end.val();
        });
    </script>

@endsection
