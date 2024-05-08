<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    // public function favorites()
    // {
    //     return $this->hasMany(Favorite::class);
    // }

    public function responsedVacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'responses');
    }

    public function favoritedVacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'favorites');
    }
    
}
