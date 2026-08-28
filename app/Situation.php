<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    protected $fillable = [
        'proprietaires_id', 'mois', 'annee', 'total_encaisse', 'total_taxes', 'total_depenses',
        'commission_taux', 'commission_montant', 'montant_net', 'users_id',
    ];

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class, 'proprietaires_id');
    }

    public function reglements()
    {
        return $this->belongsToMany(Reglement::class, 'situation_reglement', 'situations_id', 'reglements_id')
            ->withTimestamps();
    }
}
