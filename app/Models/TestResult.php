<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function test(){
        return $this->belongsTo(Test::class);
    }

    public function question(){
        return $this->belongsTo(Question::class,'question_id');
    }

    public function choice(){
        return $this->belongsTo(Choice::class);
    }
}
