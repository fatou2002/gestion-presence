<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['nom'];
    public function creneaux()
    {
        return $this->hasMany(Creneau::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }


}
