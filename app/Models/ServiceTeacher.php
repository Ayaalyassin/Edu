<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'type',
        'profile_teacher_id'
    ];

    public function profile_teacher()
    {
<<<<<<< HEAD
        return $this->hasOne(ProfileTeacher::class, 'profile_teacher_id');
    }

    public function hour_lock()
    {
        return $this->hasMany(LockHour::class, 'service_id', 'id');
=======
        return $this->belongsTo(ProfileTeacher::class, 'profile_teacher_id');
    }

    public function appointment_availables()
    {
        return $this->hasMany(AppointmentAvailable::class,'service_teacher_id','id');
>>>>>>> origin/khader
    }
}
