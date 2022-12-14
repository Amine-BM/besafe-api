<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alertvv extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAlertVV';

    protected $fillable = [
        'idAlerteVV',
        'nivDanger',
        'RefUser',
        'updated_at',
        'RefPosition'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
