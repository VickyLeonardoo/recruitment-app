<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable 
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'position_id',
        'is_active',
        'role_id',
        'departement_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function departement(){
        return $this->belongsTo(Departement::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function token(){
        return $this->hasOne(ResetPassword::class);
    }


}
