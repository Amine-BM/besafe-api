<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlerteGouvernementale extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'libelle',
        'type_alerte',
        'id_ville',
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'id_ville', 'id');
    }
}
