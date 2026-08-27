<div class="md-card">
    <div class="md-card-content large-padding">
        <div class="uk-grid uk-grid-divider uk-margin-small-bottom" data-uk-grid-margin>
            <div class="uk-width-1-1">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-3">

                        {{ Form::label('prenom', 'Prénom *') }}
                        {{ Form::text('prenom', old('prenom'),array('class'=>'md-input'.($errors->has('prenom') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('prenom', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    <div class="uk-width-medium-1-3">
                        {{ Form::label('nom', 'Nom *') }}
                        {{ Form::text('nom', old('nom'),array('class'=>'md-input'.($errors->has('nom') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('nom', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    <div class="uk-width-medium-1-3">
                        {{ Form::label('cin', 'Numero CNI') }}
                        {{ Form::text('cin', old('cin'),array('class'=>'md-input'.($errors->has('cin') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('cin', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-2">
                        {{ Form::label('adresse', 'Adresse') }}
                        {{ Form::textarea('adresse', old('adresse'),array('rows'=>'2', 'class'=>'md-input'.($errors->has('adresse') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('adresse', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    <div class="uk-width-medium-1-2">
                        {{ Form::label('telephone', 'Téléphone *') }}
                        {{ Form::text('telephone', old('telephone'),array('class'=>'md-input'.($errors->has('telephone') ? ' md-input-danger' : ''))) }}
                        {!! $errors->first('telephone', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>

                <div class="uk-grid" data-uk-grid-margin>

                    <div class="uk-width-medium-1-2">
                        {{ Form::label('date_deb_mandat', 'Date debut Mandat') }}
                        {{ Form::text('date_deb_mandat', old('date_deb_mandat'),array('class'=>'md-input'.($errors->has('date_deb_mandat') ? ' md-input-danger' : ''), 'data-uk-datepicker' => '{format:"YYYY-MM-DD"}')) }}
                        {!! $errors->first('date_deb_mandat', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                    <div class="uk-width-medium-1-2">
                        {{ Form::label('date_fin_mandat', 'Expiration du contrat') }}
                        {{ Form::text('date_fin_mandat', old('date_fin_mandat'),array('class'=>'md-input'.($errors->has('date_fin_mandat') ? ' md-input-danger' : ''), 'data-uk-datepicker' => '{format:"YYYY-MM-DD"}')) }}
                        {!! $errors->first('date_fin_mandat', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                    </div>
                </div>
                {{--  <div class="uk-grid" data-uk-grid-margin>
                      <div class="uk-width-medium-1-1">
                          {{ Form::label('notes', 'Notes à propos du client') }}
                      </div>
                  </div>
                  <div class="uk-grid" data-uk-grid-margin>
                      <div class="uk-width-medium-1-1">
                          @if(isset($liste_options) && count($liste_options) > 0)
                              @foreach($liste_options as $option)
                                  <span class="icheck-inline">
                              {{ Form::checkbox('notes[]', $option['nom_option'], old($option['nom_option']), array('data-md-icheck', 'id'=>$option['nom_option'])) }}
                                      {{ Form::label($option['nom_option'], $option['nom_option']) }}
                          </span>
                              @endforeach
                          @endif
                      </div>
                  </div>--}}
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
