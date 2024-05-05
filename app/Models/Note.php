<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
<<<<<<< HEAD
        'profile_student_id',
        'profile_teacher_id'
=======
        'student_id',
        'teacher_id'
>>>>>>> origin/khader
    ];

    public function student()
    {
<<<<<<< HEAD
        return $this->belongsTo(ProfileStudent::class, 'profile_student_id');
=======
        return $this->belongsTo(User::class, 'student_id');
>>>>>>> origin/khader
    }

    public function teacher()
    {
<<<<<<< HEAD
        return $this->belongsTo(ProfileTeacher::class, 'profile_teacher_id');
=======
        return $this->belongsTo(User::class, 'teacher_id');
>>>>>>> origin/khader
    }
}
