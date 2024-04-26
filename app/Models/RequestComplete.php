<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestComplete extends Model
{
    use HasFactory;
    protected $table = "request_complete";
    protected $fillable = [
        'user_id',
        'cv',
        'self_identity',
        'phone',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
