<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function checkUserDetail()
    {
        // Ambil semua atribut yang harus terisi
        $requiredAttributes = [
            'user_id', 'full_name', 'identity_no', 'phone', 
            'address', 'city', 'dob', 'gender', 
            'status', 'nationality', 'religion'
        ];

        // Cek apakah setiap atribut terisi
        foreach ($requiredAttributes as $attribute) {
            if (empty($this->$attribute)) {
                return false;
            }
        }

        return true;
    }
    

}
