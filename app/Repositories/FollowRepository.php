<?php

namespace App\Repositories;

use App\Interfaces\FollowRepositoryInterface;
use App\Models\Follow;
use App\Http\Resources\FollowResource;
use App\Http\Resources\FollowCollection;

class FollowRepository implements FollowRepositoryInterface
{
    public function getAllFollows()
    {
        return Follow::all();
    }

    public function getFollowByFollowedId($userId, $followedId)
    {
        return Follow::where(
            [
                'user_id' => $userId,
                'followed_id' => $followedId
            ]
        )->first();
    }

    public function createFollow(array $input)
    {
        return new FollowResource(Follow::create($input));
    }

    public function getUserFollowing($userId)
    {
        return new FollowCollection(
            Follow::where('follows.user_id', $userId)
                ->join('users', 'users.id', '=', 'follows.followed_id')
                ->select('follows.user_id', 'follows.followed_id', 'users.name', 'users.username')
                ->orderBy("users.name", "asc")
                ->paginate(10)
        );
    }

    public function getUserFollowers($userId)
    {
        return new FollowCollection(
            Follow::where('follows.followed_id', $userId)
                ->join('users', 'users.id', '=', 'follows.user_id')
                ->select('follows.user_id', 'follows.followed_id', 'users.name', 'users.username')
                ->orderBy("users.name", "asc")
                ->paginate(10)
        );
    }
}
