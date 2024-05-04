<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'description',
        'contacts',
        'resume',
    ];

    protected static function booted()
    {
        static::creating(function ($profile) {
            $profile->contacts = $profile->contacts ?? $profile->user->email;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
