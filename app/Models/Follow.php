<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'followed_id',
    ];

    /**
     * Return the follow's user
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the followed user
     *
     * @return \App\Models\User
     */
    public function followedUser()
    {
        return $this->belongsTo(User::class, 'followed_id', 'id');
    }
}
