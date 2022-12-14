<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departement;
use App\Models\Adresse;

class Ville extends Model
{
    use HasFactory;
    protected $primaryKey = 'idVille';

    protected $fillabel = [
        'NomVille'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function adresses()
    {
        return $this->hasMany(Adresse::class, 'refVille', 'idVille');
    }
}
