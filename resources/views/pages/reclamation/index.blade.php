@extends('layouts.admin')

@section('content')

    <?php setlocale(LC_ALL, 'fr_FR.UTF8'); ?>
    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-1">
                    <div class="uk-overflow-container">
                        <div class="dt_colVis_buttons"></div>
                        <table id="dt_tableExport" data-display-length='100' class="uk-table uk-table-align-vertical">
                            <thead>
                            <tr>
                                <th>Actions</th>
                                <th>Locataire</th>
                                <th>Motif</th>
                                <th>Description</th>


                            </tr>
                            </thead>
                            <tbody>
                            @if(count($liste) > 0)
                                @foreach($liste as $key => $rec)
                                    <tr>
                                        <td class="uk-text-nowrap">
                                            <a href="#"><i class="material-icons md-24">&#xE254;</i></a>
                                            <a href="#" class="destroy-btn"
                                               data-remote="true" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">
                                                <i class="material-icons md-24">&#xE872;</i>
                                            </a>
                                        </td>
                                        <td class="uk-text-large uk-text-nowrap">{{ $rec->locataire['prenom'] ?? '' }} {{ $rec->locataire['nom'] ?? '' }}</td>
                                        <td class="uk-text-large uk-text-nowrap">{{ $rec['motif'] ?? '' }}</td>

                                        <td class="uk-text-nowrap">{{ $rec['description'] ?? '' }}</td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md-fab-wrapper fab-save">
        <a class="md-fab md-fab-success md-fab-wave-light" href="#ajouter_reclamation"
           data-uk-tooltip title="{{ $bouton_ajout_title }}" data-uk-modal="{center:true}">
            <i class="material-icons">&#xe03b;</i>
        </a>
    </div>
    <div class="uk-modal" id="ajouter_reclamation">
        <div class="uk-modal-dialog" style="width: 800px;">
            <button class="uk-modal-close uk-close" type="button"></button>
            {{ Form::open(['route' => ['reclamations.store']]) }}
            {{ csrf_field() }}

            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Ajouter une reclamation</h3>
            </div>

            {{--<div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-1-1">

                        {{ Form::label('locataires_id', 'Locataire *') }}
                        {{ Form::select('locataires_id',$listeloc ?? [], null,array('id' => 'locataires_id', 'class'=>'md-input label-fixed'.($errors->has('locataires_id') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom', 'required')) }}
                        {!! $errors->first('locataires_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}


                </div>
            </div>--}}
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-large-1-1">
                    <div class="uk-form-row">
                        {{ Form::label('locataires_id', 'Locataire *') }}
                        {{ Form::text('locataires_id', old('locataires_id'),array('class'=>'md-input'.($errors->has('locataires_id') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('locataires_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-1-1">
                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-large-1-1">
                            <div class="uk-form-row">
                                {{ Form::label('motif', 'Motif') }}
                                {{ Form::text('motif', old('motif'),array('class'=>'md-input'.($errors->has('motif') ? ' md-input-danger' : ''))) }}
                                {!! $errors->first('motif', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-1-1">

                    <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                        <div class="uk-width-1-1">
                            {{--<h4>Catégorie parent</h4>--}}
                            {{ Form::label('description', 'Description') }}
                            {{ Form::textarea('description', old('description'),array('rows'=>'2', 'class'=>'md-input'.($errors->has('description') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('description', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer">
                <button type="submit" id="ajouter_reclamation" data-disable-with="Ajout en cours..."
                        class="uk-float-right md-btn md-btn-success md-btn-wave-light">
                    Ajouter
                </button>
            </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
@section('styles')

    <link rel="stylesheet" href="{{ asset('dist/assets/skins/dropify/css/dropify.css') }}">
    <style>
        .dropify-wrapper {
            height:100px !important;
        }
    </style>

    @endsection


    @section('scripts')
            <!--  product functions -->
    <script src="{{ asset('dist/assets/js/pages/ecommerce_product_edit.min.js') }}"></script>
    <!-- select2 -->
   {{-- <script src="{{ asset('dist/bower_components/select2/dist/js/select2.min.js') }}"></script>--}}

    <!--  dropify -->
    <script src="{{ asset('dist/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

    <!--  form file input functions -->
    <script src="{{ asset('dist/assets/js/pages/forms_file_input.min.js') }}"></script>
@endsection
