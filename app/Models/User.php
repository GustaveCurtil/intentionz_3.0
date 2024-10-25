<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function invitations()
    {
    return $this->hasMany(Invitation::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'contacts', 'followed_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'contacts', 'follower_id', 'followed_id');
    }

    // Optional: Method to follow a user
    public function follow(User $user) {
        if (!$this->isFollowing($user)) {
            $this->following()->attach($user->id);
        }
    }

    // Optional: Method to unfollow a user
    public function unfollow(User $user)
    {
        if ($this->isFollowing($user)) {
            $this->following()->detach($user->id);
        }
    }

    // Optional: Method to check if following a user
    public function isFollowing(User $user)
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }

}
