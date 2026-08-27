<div class="uk-grid uk-grid-medium" data-uk-grid-margin>

    <div class="uk-width-1-1">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Details
                </h3>
            </div>
            <div class="md-card-content large-padding">
                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-large-1-1">
                        <div class="uk-form-row">
                            {{ Form::label('locataires_id', 'Locataire *') }}
                            {{ Form::text('locataires_id', old('locataires_id'),array('class'=>'md-input'.($errors->has('locataires_id') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('locataires_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div>
                </div>
                {{--<div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-1-1">

                        {{ Form::label('locataires_id', 'Locataire *') }}
                        {{ Form::select('locataires_id',$liste_loc ?? [], null,array('id' => 'locataires_id', 'class'=>'md-input label-fixed'.($errors->has('locataires_id') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom', 'required')) }}
                        {!! $errors->first('locataires_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}

                    </div>
                </div>--}}
                <div class="uk-grid uk-grid-divider uk-grid-medium" data-uk-grid-margin>
                    <div class="uk-width-large-1-1">
                        <div class="uk-form-row">
                            {{ Form::label('motif', 'Motif') }}
                            {{ Form::text('motif', old('motif'),array('class'=>'md-input'.($errors->has('motif') ? ' md-input-danger' : ''))) }}
                            {!! $errors->first('motif', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                        </div>
                    </div>
                </div>
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
    </div>
</div>

@section('styles')

    <link rel="stylesheet" href="{{ asset('dist/assets/skins/dropify/css/dropify.css') }}">
    <style>
        .dropify-wrapper {
            height:100px !important;
        }
        .icheck-inline{
            position: sticky !important;
            left: 33px !important;
        }
        .uk-nestable-panel {
            padding: unset !important;
            background: unset !important;
            border-radius: unset !important;
            border: none !important;
            text-shadow: none !important;
            -webkit-box-shadow: unset !important;
            box-shadow: unset !important;
        }
    </style>

    @endsection

    @section('scripts')
            <!--  product functions -->
    <script src="{{ asset('dist/assets/js/pages/ecommerce_product_edit.min.js') }}"></script>
    <!-- select2 -->
    <script src="{{ asset('dist/bower_components/select2/dist/js/select2.min.js') }}"></script>

    <!--  dropify -->
    <script src="{{ asset('dist/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

    <!--  form file input functions -->
    <script src="{{ asset('dist/assets/js/pages/forms_file_input.min.js') }}"></script>
@endsection