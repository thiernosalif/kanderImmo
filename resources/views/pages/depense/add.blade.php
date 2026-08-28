@extends('layouts.admin')

@section('content')

    {{ Form::open(['route' => 'depenses.store', 'enctype' => 'multipart/form-data']) }}

    <div class="uk-grid">
        <div class="uk-width-1-1 uk-container-center">
            <div class="md-card">
                <div class="md-card-content large-padding">
                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            {{ Form::label('biens_id', 'Immeuble *') }}
                            {{ Form::select('biens_id', $liste_biens, null, ['id' => 'biens_id', 'class' => 'md-input label-fixed'.($errors->has('biens_id') ? ' md-input-danger' : ''), 'required']) }}
                            {!! $errors->first('biens_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            {{ Form::label('motif', 'Motif de la dépense *') }}
                            {{ Form::text('motif', old('motif'), ['class' => 'md-input'.($errors->has('motif') ? ' md-input-danger' : ''), 'required']) }}
                            {!! $errors->first('motif', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            {{ Form::label('montant', 'Montant *') }}
                            {{ Form::number('montant', old('montant'), ['class' => 'md-input'.($errors->has('montant') ? ' md-input-danger' : ''), 'step' => 'any', 'required']) }}
                            {!! $errors->first('montant', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div>

                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                            {{ Form::label('recu', 'Reçu (si disponible — image ou PDF)') }}
                            {{ Form::file('recu', ['class' => 'md-input'.($errors->has('recu') ? ' md-input-danger' : '')]) }}
                            {!! $errors->first('recu', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper md-fab-speed-dial-horizontal fab-save" data-fab-hover>
        <div class="md-fab-wrapper-small">
            <button class="md-fab md-fab-small md-fab-success" type="submit" data-disable>
                <i class="material-icons">&#xe145;</i>
            </button>
        </div>
        <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xe896;</i></a>
    </div>

    {{ Form::close() }}

@endsection
