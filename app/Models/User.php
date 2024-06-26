<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'bio',
        'avatar',
        'cover'
    ];

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

    //relations______________________________________________________________
    public function friends()
    {
        return $this->hasMany(
            Friendship::class,
            'user_id',
            'id'
        );
    }

    // accessor ____________________________________________________________
    public function getAvatarAttribute($avatar)
    {
        if (!$avatar) {
            return "default/profile-1.jpg";
        } else {
            return $avatar;
        }
    }

    // accessor ____________________________________________________________
    public function getCoverAttribute($cover)
    {
        if (!$cover) {
            return "default/banner-small.jpg";
        } else {
            return $cover;
        }
    }
}
