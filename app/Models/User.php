<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_verified',
        'is_active',
    ];

    public function user_detail(){
        return $this->hasOne(UserDetail::class);
    }

    public function role(){
        return $this->belongsTo(Role::class,);
    }

    public function education_details(){
        return $this->hasMany(EducationDetail::class);
    }

    public function experience_details(){
        return $this->hasMany(ExperienceDetail::class);
    }

    public function skill_details(){
        return $this->hasMany(Skill::class);
    }

    public function language_details(){
        return $this->hasMany(LanguageDetail::class);
    }

    public function application(){
        return $this->hasMany(Application::class);
    }

    public function token(){
        return $this->hasOne(ResetPassword::class);
    }


    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
