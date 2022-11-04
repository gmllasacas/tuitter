<?php

namespace App\Http\Controllers;

use App\Interfaces\TweetRepositoryInterface;
use App\Http\Requests\StoreTweetRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Resources\TweetResource;
use App\Http\Resources\TweetCollection;
use App\Repositories\FollowRepository;
use App\Repositories\TweetRepository;
use Illuminate\Support\Facades\View;
use App\Models\User;

class UserController extends Controller
{
    private FollowRepository $followRepository;
    private TweetRepository $tweetRepository;

    public function __construct()
    {
        $this->followRepository = new FollowRepository();
        $this->tweetRepository = new TweetRepository();
    }

    /**
     *
     * @param Integer $id
     * @return \Illuminate\Support\Facades\View
     */
    public function index($id)
    {
        //dd(session()->get('message'));
        $user = auth()->user();
        $usersId = [];
        $followingUser = followingUser($user->id);

        if ($user) {
            if ($user->id == $id) {
                $usersId = followingUser($id);
            } else {
                $user = User::where('id', $id)->firstOrFail();
                $usersId = [$id];
            }
        }
        //dd($followingUser);
        $feed = $this->tweetRepository->getUserTweets($usersId);

        return view(
            'index',
            [
                'followingUser' => $followingUser,
                'user' => $user,
                'feed' => $feed,
            ]
        );
    }

    /**
     * Display the user's following
     *
     * @param Integer $id
     * @return \Illuminate\Support\Facades\View
     */
    public function following($id)
    {
        $following = $this->followRepository->getUserFollowing($id);
        $followingUser = followingUser($id);

        return view(
            'following',
            [
                'followingUser' => $followingUser,
                'following' => $following,
            ]
        );
    }

    /**
     * Display the user's followers
     *
     * @param Integer $id
     * @return \Illuminate\Support\Facades\View
     */
    public function followers($id)
    {
        $followers = $this->followRepository->getUserFollowers($id);
        $followingUser = followingUser($id);

        return view(
            'followers',
            [
                'followingUser' => $followingUser,
                'followers' => $followers,
            ]
        );
    }
}
