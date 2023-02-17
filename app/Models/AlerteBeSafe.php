<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlerteBeSafe extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'libelle',
        'niveau_danger',
        'type_alerte',
        'id_adresse',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function adresse()
    {
        return $this->belongsTo(Adresse::class, 'id_adresse', 'id');
    }

    public function typeAlerte()
    {
        return $this->belongsTo(TypeAlerte::class, 'type_alerte', 'libelle');
    }
}
