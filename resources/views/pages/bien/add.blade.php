<div class="md-card">
    <div class="md-card-content large-padding">
        <div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
            <div class="uk-width-1-1">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">

                        {{ Form::label('proprietaires_id', 'Proprietaire *') }}
                        {{ Form::select('proprietaires_id',$liste_prop ?? [], null,array('id' => 'proprietaires_id', 'class'=>'md-input label-fixed'.($errors->has('proprietaires_id') ? ' md-input-danger' : ''), 'data-md-selectize', 'data-md-selectize-bottom', 'required')) }}
                        {!! $errors->first('proprietaires_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        {{ Form::label('adresse', 'Adresse') }}
                        {{ Form::textarea('adresse', old('adresse'),array('rows'=>'2', 'class'=>'md-input'.($errors->has('adresse') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('adresse', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    <div class="uk-width-medium-1-2">
                        <div class="parsley-row">
                            <label>Type de bien</label>
                            <select required class="md-input produit_liste" id="type" name="type" data-md-selectize data-md-selectize-bottom {{--onchange="status(this.value)"--}}>
                                {{--<option value="0">Commande</option>--}}
                                <option value="maison">MAISON</option>
                                <option value="terrain">TERRAIN</option>
                                <option value="autres">AUTRES</option>

                            </select>
                        </div>
                </div>
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
