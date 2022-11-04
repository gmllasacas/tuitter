<?php

namespace App\Repositories;

use App\Interfaces\TweetRepositoryInterface;
use App\Models\Tweet;
use App\Http\Resources\TweetResource;
use App\Http\Resources\TweetCollection;

class TweetRepository implements TweetRepositoryInterface
{
    public function getAllTweets()
    {
        return Tweet::all();
    }

    public function getTweetById($tweetId)
    {
        return Tweet::findOrFail($tweetId);
    }

    public function createTweet(array $input)
    {
        return new TweetResource(Tweet::create($input));
    }

    public function getUserTweets($usersId)
    {
        return new TweetCollection(Tweet::whereIn('user_id', $usersId)->orderBy("created_at", "desc")->paginate(10));
    }
}
