<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $fillable = [
        'proprietaires_id','adresse', 'type','description','num'
    ];

    public function proprietaire(){
        return $this->belongsTo('App\Proprietaire', 'proprietaires_id');
    }
    public function articles(){
        return $this->hasMany('App\Article','biens_id');
    }
}
