<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    protected $fillable = [
        'cin', 'nom', 'prenom', 'adresse','telephone', 'date_deb_mandat', 'date_fin_mandat','users_id'
    ];

    public function biens(){
        return $this->hasMany(Bien::class);
    }

    public function situations(){
        return $this->hasMany(Situation::class);
    }
}
