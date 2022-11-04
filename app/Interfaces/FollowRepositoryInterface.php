<?php

namespace App\Interfaces;

interface FollowRepositoryInterface
{
    public function getAllFollows();
    public function getFollowByFollowedId($userId, $followedId);
    public function createFollow(array $details);
    public function getUserFollowing($userId);
    public function getUserFollowers($userId);
}
