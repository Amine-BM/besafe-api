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
        'libelle'
    ];
    protected $primaryKey = 'code';

    public function villes()
    {
        return $this->hasMany(Ville::class, 'code_departement', 'code');
    }

    public function alertesGouv()
    {
        return $this->hasMany(AlerteGouv::class,'code_departement', 'code');
    }
}
