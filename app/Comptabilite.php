<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comptabilite extends Model
{
    protected $fillable = [
        'reglements_id','user_id','retrait', 'depot', 'motif', 'total', 'biens_id', 'recu'
    ];

    public function bien()
    {
        return $this->belongsTo(Bien::class, 'biens_id');
    }
}
