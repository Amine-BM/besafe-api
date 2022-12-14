<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ville;
use App\Models\AlerteGouv;

class Departement extends Model
{
    use HasFactory;
    protected $fillabel = [
        'NomDepartement'
    ];
    protected $primaryKey = 'idDepartement';

    public function villes()
    {
        return $this->hasMany(Ville::class, 'refDepartement', 'idDepartement');
    }

    public function alertesGouv()
    {
        return $this->hasMany(AlerteGouv::class, 'refDepartement', 'idDepartement');
    }
}
