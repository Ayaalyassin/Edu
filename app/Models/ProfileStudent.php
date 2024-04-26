<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'educational_level',
        'description',
        'user_id',
        'assessing',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function intrests()
    {
        return $this->hasMany(Intrest::class, 'profile_student_id', 'id');
    }

    public function teaching_methods_user()
    {
        return $this->belongsToMany(
            TeachingMethod::class,
            'teaching_method_users',
            'profile_student_id',
            'teaching_method_id'
        )->withPivot('id');
    }

    public function evaluation_as_student()
    {
        return $this->hasMany(Evaluation::class, 'profile_student_id', 'id');
    }

    public function note_as_student()
    {
        return $this->hasMany(Note::class, 'profile_student_id', 'id');
    }

    public function report_as_reporter()
    {
        return $this->morphMany(Report::class, 'reporter');
    }

    public function report_as_reported()
    {
        return $this->morphMany(Report::class, 'reported');
    }


}
