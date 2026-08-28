@extends('layouts.admin')

@section('content')

    <div class="uk-grid">
        <div class="uk-width-1-1 uk-container-center">
            <div class="md-card">
                <div class="md-card-content large-padding">
                    <h3>
                        {{ optional($situation->proprietaire)->prenom }} {{ optional($situation->proprietaire)->nom }}
                        — {{ $situation->mois }} {{ $situation->annee }}
                    </h3>

                    <p>
                        Coche ou décoche les règlements à inclure dans cette situation. Les totaux, la commission et
                        le montant net seront recalculés automatiquement. Les dépenses ne sont pas modifiées ici.
                    </p>

                    {{ Form::open(['route' => ['situations.update', $situation], 'method' => 'PUT']) }}

                    <table class="uk-table uk-table-striped">
                        <thead>
                            <tr>
                                <th>Inclure</th>
                                <th>Locataire</th>
                                <th>Immeuble</th>
                                <th>Mois payé</th>
                                <th>Loyer</th>
                                <th>Taxe</th>
                                <th>Date d'encaissement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($candidats as $reg)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="reglements_id[]" value="{{ $reg->id }}"
                                               @if($idsInclus->contains($reg->id)) checked @endif>
                                    </td>
                                    <td>{{ optional($reg->locataire)->prenom }} {{ optional($reg->locataire)->nom }}</td>
                                    <td>{{ optional(optional($reg->article)->bien)->adresse }}</td>
                                    <td>{{ $reg->mois_paie }}</td>
                                    <td>{{ number_format($reg->montant, 0, ',', ' ') }}</td>
                                    <td>{{ $reg->taxe ? number_format($reg->taxe, 0, ',', ' ') : '-' }}</td>
                                    <td>{{ optional($reg->created_at)->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Aucun règlement disponible pour ce propriétaire.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <button type="submit" class="md-btn md-btn-success" data-disable-with="Enregistrement...">
                        Enregistrer
                    </button>
                    <a href="{{ route('situations.index') }}" class="md-btn md-btn-flat">Annuler</a>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
