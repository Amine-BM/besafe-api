<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Adresse;
use App\Models\Alertv;
use App\Models\Alertvv;
use App\Models\Alertvp;

class Position extends Model
{
    use HasFactory;
    protected $primaryKey = 'idPosition';
    public $timestamps = false;

    protected $fillable = [
        'Latitude',
        'Longitude',
        'refAdresse'
    ];

    public function adresse()
    {
        return $this->belongsTo(Adresse::class, 'refAdresse', 'idAdresse');
    }

    public function alertvs()
    {
        return $this->hasMany(Alertv::class, 'refPosition', 'idPosition');
    }

    public function alertvvs()
    {
        return $this->hasMany(Alertvv::class, 'refPosition', 'idPosition');
    }

    public function alertvps()
    {
        return $this->hasMany(Alertvp::class, 'refPosition', 'idPosition');
    }
}
