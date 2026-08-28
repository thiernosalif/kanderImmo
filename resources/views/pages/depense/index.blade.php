@extends('layouts.admin')

@section('content')

    <?php setlocale(LC_ALL, 'fr_FR.UTF8'); ?>
    <div class="md-card">
        <div class="md-card-content">
            <div class="uk-grid" data-uk-grid-margin>
                <div class="uk-width-1-1">
                    <div class="uk-overflow-container">
                        <div class="dt_colVis_buttons"></div>
                        <table id="dt_tableExport" class="uk-table uk-table-align-vertical">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Immeuble</th>
                                    <th>Motif</th>
                                    <th>Montant</th>
                                    <th>Reçu</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($liste) > 0)
                                    @foreach($liste as $depense)
                                        <tr>
                                            <td class="uk-text-nowrap">
                                                <a href="{{ route('depenses.delete', $depense->id) }}" class="destroy-btn"
                                                   data-remote="true" data-confirm="Êtes-vous sûr de vouloir supprimer cette dépense ?">
                                                    <i class="material-icons md-24">&#xE872;</i>
                                                </a>
                                            </td>
                                            <td>{{ optional($depense->bien)->adresse }}</td>
                                            <td>{{ $depense->motif }}</td>
                                            <td>{{ number_format($depense->retrait, 0, ',', ' ') }}</td>
                                            <td>
                                                @if($depense->recu)
                                                    <a href="{{ asset('storage/'.$depense->recu) }}" target="_blank">Voir le reçu</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ optional($depense->created_at)->format('d/m/Y') }}</td>
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
        <a class="md-fab md-fab-success md-fab-wave-light" href="{{ route('depenses.create') }}" title="Ajouter une dépense">
            <i class="material-icons">&#xe03b;</i>
        </a>
    </div>

@endsection
