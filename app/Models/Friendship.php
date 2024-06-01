<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Friendship extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'user_id', 'friend_id'];

    // relations_____________________________________________
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
