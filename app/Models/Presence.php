<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{

    // Autoriser le remplissage en masse
    protected $fillable = [
        'user_id',
        'date',
        'heure_arrivee',
        'heure_depart',
        'statut',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
