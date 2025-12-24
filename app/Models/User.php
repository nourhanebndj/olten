<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword as ResetPasswordNotification;


class User extends Authenticatable
{
    use HasFactory, Notifiable; // <-- corriger ici

    public $timestamps = false;

    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'email',
        'password',
        'about_me',
        'phone',
        'gender',
        'disable_email_notifications',
        'x_com',
        'facebook',
        'linkedin',
        'instagram',
        'youtube',
        'tiktok',
        'whatsapp',
        'identity_verification',
        'profile_photo',
        'is_admin',
        'verifie',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
