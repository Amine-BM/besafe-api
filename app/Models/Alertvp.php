<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alertvp extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAlertVP';

    protected $fillable = [
        'idAlerteVP',
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
