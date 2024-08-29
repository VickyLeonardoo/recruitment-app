<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function departement(){
        return $this->belongsTo(Departement::class);
    }
}
