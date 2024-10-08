<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function language_details(){
        return $this->hasMany(LanguageDetail::class);
    }

}
