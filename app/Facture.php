<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'code','numFacture','proprietaires_id','reglements_id'
    ];
}
