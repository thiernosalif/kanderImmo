@extends('layouts.admin')

@section('content')

    <div class="uk-grid">
        <div class="uk-width-1-1 uk-container-center">

            @if($dejaGeneree)
                <div class="uk-alert uk-alert-warning">
                    Une situation existe déjà pour <strong>{{ $proprietaire->prenom }} {{ $proprietaire->nom }}</strong>
                    en <strong>{{ $mois }} {{ $annee }}</strong>. Retrouve-la dans la liste des situations.
                </div>
            @endif

            <div class="md-card">
                <div class="md-card-content large-padding">
                    <h3>{{ $proprietaire->prenom }} {{ $proprietaire->nom }} — {{ $mois }} {{ $annee }}</h3>

                    <table class="uk-table uk-table-striped">
                        <thead>
                            <tr>
                                <th>Locataire</th>
                                <th>Immeuble</th>
                                <th>Mois payé</th>
                                <th>Loyer</th>
                                <th>Taxe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lignes as $ligne)
                                <tr>
                                    <td>{{ optional($ligne['locataire'])->prenom }} {{ optional($ligne['locataire'])->nom }}</td>
                                    <td>{{ optional($ligne['bien'])->adresse }}</td>
                                    <td>{{ optional($ligne['reglement'])->mois_paie ?? '-' }}</td>
                                    <td>{{ $ligne['reglement'] ? number_format($ligne['reglement']->montant, 0, ',', ' ') : '-' }}</td>
                                    <td>{{ optional($ligne['reglement'])->taxe ? number_format($ligne['reglement']->taxe, 0, ',', ' ') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Aucun locataire trouvé pour ce propriétaire.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <table class="uk-table" style="max-width: 400px; margin-left: auto;">
                        <tr>
                            <th>Total encaissé (loyers + taxes)</th>
                            <td>{{ number_format($totalEncaisse, 0, ',', ' ') }}</td>
                        </tr>
                        <tr>
                            <th>&nbsp;&nbsp;dont taxes (hors commission)</th>
                            <td>{{ number_format($totalTaxes, 0, ',', ' ') }}</td>
                        </tr>
                        <tr>
                            <th>Dépenses (immeubles du propriétaire)</th>
                            <td>{{ number_format($totalDepenses, 0, ',', ' ') }}</td>
                        </tr>
                        <tr>
                            <th>Commission de gérance ({{ $commissionTaux }}% du loyer, hors taxes)</th>
                            <td>{{ number_format($commissionMontant, 0, ',', ' ') }}</td>
                        </tr>
                        <tr>
                            <th>Montant net à remettre</th>
                            <td><strong>{{ number_format($montantNet, 0, ',', ' ') }}</strong></td>
                        </tr>
                    </table>

                    @unless($dejaGeneree)
                        {{ Form::open(['route' => 'situations.store']) }}
                        {{ Form::hidden('proprietaires_id', $proprietaire->id) }}
                        {{ Form::hidden('mois', $mois) }}
                        {{ Form::hidden('annee', $annee) }}
                        <button type="submit" class="md-btn md-btn-success" data-disable-with="Enregistrement...">
                            Confirmer et enregistrer la situation
                        </button>
                        {{ Form::close() }}
                    @endunless

                    <a href="{{ route('situations.create') }}" class="md-btn md-btn-flat">Modifier la sélection</a>
                </div>
            </div>
        </div>
    </div>

@endsection
