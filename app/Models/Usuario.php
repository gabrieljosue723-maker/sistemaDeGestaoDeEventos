<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use SoftDeletes;


    protected $fillable = [
        'nome',
        'email',
        'password',
        'foto',
        'remember_token'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'usuario_id');
    }
}
