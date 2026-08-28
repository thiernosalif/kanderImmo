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
                                    <th>Propriétaire</th>
                                    <th>Mois</th>
                                    <th>Année</th>
                                    <th>Total encaissé</th>
                                    <th>Taxes</th>
                                    <th>Dépenses</th>
                                    <th>Commission</th>
                                    <th>Montant net</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($liste) > 0)
                                    @foreach($liste as $situation)
                                        <tr>
                                            <td class="uk-text-nowrap">
                                                <a href="{{ route('situations.show', $situation) }}" title="Télécharger le PDF">
                                                    <i class="material-icons md-24">&#xE2C4;</i>
                                                </a>
                                                <a href="{{ route('situations.delete', $situation->id) }}" class="destroy-btn"
                                                   data-remote="true" data-confirm="Êtes-vous sûr de vouloir supprimer cette situation ?">
                                                    <i class="material-icons md-24">&#xE872;</i>
                                                </a>
                                            </td>
                                            <td>{{ optional($situation->proprietaire)->prenom }} {{ optional($situation->proprietaire)->nom }}</td>
                                            <td>{{ $situation->mois }}</td>
                                            <td>{{ $situation->annee }}</td>
                                            <td>{{ number_format($situation->total_encaisse, 0, ',', ' ') }}</td>
                                            <td>{{ number_format($situation->total_taxes, 0, ',', ' ') }}</td>
                                            <td>{{ number_format($situation->total_depenses, 0, ',', ' ') }}</td>
                                            <td>{{ number_format($situation->commission_montant, 0, ',', ' ') }}</td>
                                            <td><strong>{{ number_format($situation->montant_net, 0, ',', ' ') }}</strong></td>
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
        <a class="md-fab md-fab-success md-fab-wave-light" href="{{ route('situations.create') }}" title="Générer une situation">
            <i class="material-icons">&#xe03b;</i>
        </a>
    </div>

@endsection
