@extends('layouts.admin')

@section('content')

    {{ Form::open(['route' => 'situations.preview', 'method' => 'GET']) }}

    <div class="uk-grid">
        <div class="uk-width-1-1 uk-container-center">
            <div class="md-card">
                <div class="md-card-content large-padding">
                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            {{ Form::label('proprietaires_id', 'Propriétaire *') }}
                            {{ Form::select('proprietaires_id', $liste_prop, null, ['id' => 'proprietaires_id', 'class' => 'md-input label-fixed', 'required']) }}
                        </div>
                    </div>

                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                            {{ Form::label('mois', 'Mois *') }}
                            {{ Form::select('mois', $listes_mois, null, ['id' => 'mois', 'class' => 'md-input label-fixed', 'required']) }}
                        </div>
                        <div class="uk-width-medium-1-2">
                            {{ Form::label('annee', 'Année *') }}
                            {{ Form::select('annee', $listes_annees, null, ['id' => 'annee', 'class' => 'md-input label-fixed', 'required']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper md-fab-speed-dial-horizontal fab-save" data-fab-hover>
        <div class="md-fab-wrapper-small">
            <button class="md-fab md-fab-small md-fab-success" type="submit" title="Voir l'aperçu" data-disable>
                <i class="material-icons">&#xe8b6;</i>
            </button>
        </div>
        <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xe896;</i></a>
    </div>

    {{ Form::close() }}

@endsection
