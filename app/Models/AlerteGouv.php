<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departement;

class AlerteGouv extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAlerteGouv';
    public $timestamps = false;

    protected $fillable = [
        'Annee',
        'Mois',
        'NombreCrime',
        'LibeleeAlerte',
        'RefDepartement'
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'RefDepartement', 'idDepartement');
    }
}
