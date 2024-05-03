<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'company_name',
        'city',
        'salary_min',
        'salary_max',
        'experience',
        'responsibilities',
        'requirements',
        'conditions',
        'skills',
    ];
}
