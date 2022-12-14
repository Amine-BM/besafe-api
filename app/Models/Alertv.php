<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Position;

class Alertv extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAlerteV';

    protected $fillable = [
        'nivDanger',
        'RefUser',
        'updated_at',
        'RefPosition'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'RefUser', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'RefPosition', 'idPosition');
    }
}
