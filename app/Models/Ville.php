<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departement;
use App\Models\Adresse;

class Ville extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillabel = [
        'libelle',
        'code_departement'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'code_departement', 'code');
    }

    public function adresses()
    {
        return $this->hasMany(Adresse::class, 'id_ville', 'id');
    }
}
