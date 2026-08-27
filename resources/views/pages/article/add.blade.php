<h3>
    {{--Article  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;--}}
    <span>
         {{ Form::hidden('disponibilite', 0) }}
        {{ Form::checkbox('disponibilite', 1,array('data-switchery', 'data-switchery-size'=>'large', 'data-switchery-color' => '#1e88e5')) }}
        {{ Form::label('disponibilite', 'disponibilite', ['class' => 'inline-label']) }}
    </span>
</h3>

<div class="md-card">
    <div class="md-card-content large-padding">
        <div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
            <div class="uk-width-1-1">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">

                        {{ Form::label('locataires_id', 'Locataire *') }}
                        {{ Form::select('locataires_id',$liste_loc ?? [], null,array('id' => 'locataires_id', 'class'=>'md-input label-fixed'.($errors->has('locataires_id') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom', 'required')) }}
                        {!! $errors->first('locataires_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">

                        {{ Form::label('biens_id', 'Bien *') }}
                        {{ Form::select('biens_id',$liste_biens ?? [], null,array('id' => 'biens_id', 'class'=>'md-input label-fixed'.($errors->has('biens_id') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom', 'required')) }}
                        {!! $errors->first('biens_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                        {{ Form::label('structure_ar', 'Structure de l\'article') }}
                        {{ Form::textarea('structure_ar', old('structure_ar'),array('rows'=>'2', 'class'=>'md-input'.($errors->has('structure_ar') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('structure_ar', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                   {{-- <div class="uk-width-medium-1-2">
                        {{ Form::hidden('disponibilite', 0) }}
                        {{ Form::checkbox('disponibilite', 1,array('data-switchery', 'data-switchery-size'=>'large', 'data-switchery-color' => '#1e88e5')) }}
                        {{ Form::label('disponibilite', 'La disponibilite', ['class' => 'inline-label']) }}
                    </div>--}}
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
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
        </style>

        @endsection

        @section('scripts')

                <!--  dropify -->
        <script src="{{ asset('dist/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

        <!--  form file input functions -->
        <script src="{{ asset('dist/assets/js/pages/forms_file_input.min.js') }}"></script>

@endsection
