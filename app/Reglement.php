<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    protected $fillable = [
        'locataires_id','articles_id','created_at', 'mois_paie', 'montant', 'taxe', 'mode_reglement',
         'avance','complement','acompte','transactionReference'
    ];

    public function locataire(){
        return $this->belongsTo('App\Locataire','locataires_id');
    }

    public function article(){
        return $this->belongsTo('App\Article','articles_id');
    }


    public function user()
{
    return $this->belongsTo(User::class, 'users_id');
}

    public function situations()
    {
        return $this->belongsToMany(Situation::class, 'situation_reglement', 'reglements_id', 'situations_id');
    }
}
