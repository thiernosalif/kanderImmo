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
                                <th>Proprietaire</th>
                                <th>Adresse</th>
                                <th>Type</th>
                                <th>Description</th>


                            </tr>
                            </thead>
                            <tbody>
                            @if(count($liste) > 0)
                                @foreach($liste as $key => $biens)
                                    <tr>
                                        <td class="uk-text-nowrap">
                                            <a href="{{ route($route.'.edit', $biens)}}"><i class="material-icons md-24">&#xE254;</i></a>
                                            <a href="{{ route($route.'.delete', $biens->id) }}" class="destroy-btn"
                                                data-remote="true" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">
                                                 <i class="material-icons md-24">&#xE872;</i>
                                             </a>
                                        </td>
                                        <td>{{ $biens->proprietaire['prenom'] ?? '' }}</td>
                                        <td class="uk-text-large uk-text-nowrap">{{ $biens['adresse'] ?? '' }}</td>


                                        <td>{{ $biens['type'] ?? '' }}</td>
                                        <td>{{ $biens['description'] ?? '' }}</td>

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



    <div class="md-fab-wrapper md-fab-speed-dial-horizontal fab-save" data-fab-hover>
        <div class="md-fab-wrapper-small">
            <a class="md-fab md-fab-small md-fab-warning" href="#mailbox_new_message"
               data-uk-modal="{center:true}" data-uk-tooltip="{cls:'uk-tooltip-small',pos:'left'}" title="Importer depuis excel">
                <i class="material-icons">&#xE2C3;</i>
            </a>
            <a class="md-fab md-fab-success md-fab-small" href="{{ route('biens.create') }}" title="{{ $bouton_ajout_title }}">
                <i class="material-icons">&#xe03b;</i>
            </a>
        </div>
        <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xe896;</i></a>
    </div>

    <div class="uk-modal" id="mailbox_new_message">
        <div class="uk-modal-dialog">
            <button class="uk-modal-close uk-close" type="button"></button>
            <form method="POST" action="#" enctype="multipart/form-data">
                {{@csrf_field()}}
                <div class="uk-modal-header">
                    <h3 class="uk-modal-title">Importer des clients depuis excel</h3>
                </div>
                <div class="uk-margin-medium-bottom">

                    <input id="form-file" class="md-input" name="excel_file" type="file" required>
                </div>
                <div class="uk-modal-footer">
                    <button type="submit" class="uk-float-right md-btn md-btn-flat md-btn-flat-primary">Importer</button>
                </div>
            </form>
        </div>
    </div>
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
