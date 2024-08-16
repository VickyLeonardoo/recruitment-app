<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'image',
        'difficult',
    ];

    public function getTypeAttribute($value)
    {
        $labels = [
            'multiple_choice' => 'Multiple Choice',
            'true_false' => 'True/False',
        ];

        return $labels[$value];
    }

    // Accessor for 'difficult' field
    public function getDifficultAttribute($value)
    {
        $labels = [
            'easy' => 'Easy',
            'medium' => 'Medium',
            'hard' => 'Hard',
        ];

        return $labels[$value];
    }

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

}
