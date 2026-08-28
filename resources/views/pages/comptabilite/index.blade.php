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
                                <th>Utilisateur</th>
                                <th>Motif</th>
                                <th>Depot</th>
                                <th>Retrait</th>


                            </tr>
                            </thead>
                            <tbody>
                            @if(count($liste) > 0)
                                @foreach($liste as $key => $c)
                                    <tr>
                                        <td class="uk-text-nowrap">
                                            <a href="#"><i class="material-icons md-24">&#xE254;</i></a>
                                            <a href="#" class="destroy-btn"
                                               data-remote="true" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">
                                                <i class="material-icons md-24">&#xE872;</i>
                                            </a>
                                        </td>
                                        <td class="uk-text-large uk-text-nowrap">{{ auth()->user()->prenom ?? '' }} {{ auth()->user()->nom ?? '' }}</td>
                                        <td class="uk-text-large uk-text-nowrap">{{ $c['motif'] ?? '' }}</td>

                                        <td class="uk-text-nowrap">{{ $c['depot'] ?? '' }}</td>
                                        <td class="uk-text-nowrap">{{ $c['retrait'] ?? '' }}</td>

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

   @if($id == "depot")
       <div class="md-fab-wrapper fab-save">
           <a class="md-fab md-fab-success md-fab-wave-light" href="#ajouter_depot"
              data-uk-tooltip title="{{ $bouton_ajout_title }}" data-uk-modal="{center:true}">
               <i class="material-icons">&#xe03b;</i>
           </a>
       </div>
       <div class="uk-modal" id="ajouter_depot">
           <div class="uk-modal-dialog" style="width: 800px;">
               <button class="uk-modal-close uk-close" type="button"></button>
               {{ Form::open(['route' => ['comptabilites.debiter']]) }}
               {{ csrf_field() }}

               <div class="uk-modal-header">
                   <h3 class="uk-modal-title">Debiter le compte</h3>
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
                                   {{ Form::label('depot', 'Depot') }}
                                   {{ Form::number('depot', old('depot'),array('class'=>'md-input'.($errors->has('depot') ? ' md-input-danger' : ''))) }}
                                   {!! $errors->first('depot', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="uk-modal-footer">
                   <button type="submit" id="ajouter_depot" data-disable-with="Ajout en cours..."
                           class="uk-float-right md-btn md-btn-success md-btn-wave-light">
                       Ajouter
                   </button>
               </div>

               {{ Form::close() }}
           </div>
       </div>
    @elseif($id == "retrait")
       <div class="md-fab-wrapper fab-save">
           <a class="md-fab md-fab-success md-fab-wave-light" href="#ajouter_credit"
              data-uk-tooltip title="{{ $bouton_ajout_title }}" data-uk-modal="{center:true}">
               <i class="material-icons">&#xe03b;</i>
           </a>
       </div>
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
                                   {{ Form::number('retrait', old('retrait'),array('class'=>'md-input'.($errors->has('retrait') ? ' md-input-danger' : ''))) }}
                                   {!! $errors->first('retrait', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
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
                                   {{ Form::label('biens_id', 'Immeuble concerné (pour la situation du propriétaire)') }}
                                   {{ Form::select('biens_id', $liste_biens, old('biens_id'), array('class'=>'md-input'.($errors->has('biens_id') ? ' md-input-danger' : ''))) }}
                                   {!! $errors->first('biens_id', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}
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
    @endif
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
