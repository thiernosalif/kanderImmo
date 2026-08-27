<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comptabilite extends Model
{
    protected $fillable = [
        'reglements_id','user_id','retrait', 'depot', 'motif', 'total'
    ];

   /* public function comptablite(){
        return $this->belongsTo(Reglement::class);
    }*/

    /*public function comptablite1(){
        return $this->belongsTo(User::class);
    }*/
}
