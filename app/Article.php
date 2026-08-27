<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'biens_id','locataires_id','structure_ar', 'disponibilite'
    ];

    public function bien(){
        return $this->belongsTo('App\Bien','biens_id');
    }

    public function locataire(){
        return $this->belongsTo('App\Locataire', 'locataires_id');
    }
    public function reglements(){
        return $this->hasMany('App\Reglement','articles_id');
    }
}
