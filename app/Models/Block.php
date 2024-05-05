<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $table = "blocks_users";
=======
    protected $table = "blocks";
>>>>>>> origin/khader
    protected $fillable = ['user_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
