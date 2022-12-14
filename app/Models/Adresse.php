<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;

class Adresse extends Model
{
    use HasFactory;
    protected $primaryKey = 'idAdresse';
    public $timestamps = false;

    protected $fillable = [
        'Numero',
        'Rue',
        'refVille'
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'refVille', 'idVille');
    }

    public function positions()
    {
        return $this->hasMany(Position::class, 'refAdresse', 'idAdresse');
    }
}
