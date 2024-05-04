<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cover',
        'title',
        'company',
        'city',
        'salary_from',
        'salary_to',
        'experience',
        'responsibilities',
        'requirements',
        'conditions',
        'skills',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
