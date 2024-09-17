<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function job(){
        return $this->belongsTo(JobVacancy::class,'job_vacancy_id');
    }

    public function line(){
        return $this->hasMany(ScheduleLine::class);
    }

}
