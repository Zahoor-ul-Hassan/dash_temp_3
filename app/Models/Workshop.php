<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $fillable = ['name','status', 'fee', 'description'];
    public function teacher()
    {
        return $this->belongsToMany(User::class, 'workshop_teacher', 'workshop_id', 'teacher_id');
    }

    public function manager()
    {
        return $this->belongsToMany(User::class, 'workshop_manager', 'workshop_id', 'manager_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'workshop_student', 'workshop_id', 'student_id');
    }
}
