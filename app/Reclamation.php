<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reclamation extends Model
{
    protected $fillable = [
        'locataires_id','motif', 'description'
    ];

    public function locataire(){
        return $this->belongsTo('App\Locataire', 'locataires_id');
    }
}
