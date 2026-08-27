<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    protected $fillable = [
        'proprietaires_id','reglements_id',
    ];
}
