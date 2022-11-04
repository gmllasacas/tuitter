<?php

namespace App\Interfaces;

interface TweetRepositoryInterface
{
    public function getAllTweets();
    public function getTweetById($tweetId);
    public function createTweet(array $details);
    public function getUserTweets($userId);
}
