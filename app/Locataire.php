<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    protected $fillable = [
        'cin', 'nom', 'prenom', 'adresse','telephone','users_id', 'coordonne_pro', 'loyer_base', 'total_loyer',  'date_entre', 'expiration_contrat'
    ];

    public function reclamations(){
        return $this->hasMany('App\Reclamation','locataires_id');
    }

    public function articles(){
        return $this->hasMany('App\Article','locataires_id');
    }

    public function reglements(){
        return $this->hasMany('App\Reglement','locataires_id');
    }
}
