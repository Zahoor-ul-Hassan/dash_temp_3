<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];
    public function isAdmin()
{
    return $this->role === 'admin';
}

public function isTeacher()
{
    return $this->role === 'teacher';
}

public function isManager()
{
    return $this->role === 'manager';
}

public function workshopsAsTeacher()
{
    return $this->belongsToMany(Workshop::class, 'workshop_teacher', 'teacher_id', 'workshop_id')->where('role','teacher');
    
}

public function workshopsAsManager()
{
    return $this->belongsToMany(Workshop::class, 'workshop_manager', 'manager_id', 'workshop_id')->where('role','manager');
    
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
    ];
}
