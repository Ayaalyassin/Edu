<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'profile_student_id',
        'profile_teacher_id'
    ];

    public function student()
    {
        return $this->belongsTo(ProfileStudent::class, 'profile_student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(ProfileTeacher::class, 'profile_teacher_id');
    }
}
