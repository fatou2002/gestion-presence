<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creneau extends Model
{
    use HasFactory;

    protected $table = 'creneaux';
    // Définit les attributs qui peuvent être affectés en masse
    protected $fillable = [
        'nom',
        'heure_debut',
        'heure_fin',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
