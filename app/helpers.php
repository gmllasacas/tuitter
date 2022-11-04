<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;

if (! function_exists('followingUser')) {
    function followingUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $followingCol = $user->following->map->only(['followed_id']);
            return  array_merge(
                [$user->id],
                array_column($followingCol->toArray(), 'followed_id')
            );
        } else {
            return [];
        }
    }
}
