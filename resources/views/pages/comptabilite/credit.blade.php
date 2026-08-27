@extends('layouts.admin')

@section('content')
    <div class="uk-modal" id="ajouter_credit">
        <div class="uk-modal-dialog" style="width: 800px;">
            <button class="uk-modal-close uk-close" type="button"></button>
            {{ Form::open(['route' => ['comptabilites.crediter']]) }}
            {{ csrf_field() }}

            <div class="uk-modal-header">
                <h3 class="uk-modal-title">Crediter le compte</h3>
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
                            <div class="uk-form-row">
                                {{ Form::label('retrait', 'retrait') }}
                                {{ Form::text('retrait', old('retrait'),array('class'=>'md-input'.($errors->has('retrait') ? ' md-input-danger' : ''))) }}
                                {!! $errors->first('retrait', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer">
                <button type="submit" id="ajouter_retrait" data-disable-with="Ajout en cours..."
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
