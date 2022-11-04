<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Interfaces\FollowRepositoryInterface;
use App\Http\Requests\StoreFollowRequest;
use App\Http\Requests\StoreFollowUsernameRequest;
use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    private FollowRepositoryInterface $followRepository;

    public function __construct(FollowRepositoryInterface $followRepository)
    {
        $this->followRepository = $followRepository;
    }

    /**
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function index()
    {
        return view(
            'follow'
        );
    }

    /**
     * Follow an user
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function follow($id)
    {
        $userId = auth()->user()->id;

        if ($this->followRepository->getFollowByFollowedId($userId, $id)) {
            return back()->withErrors('You already follow that user');
        }

        $input = [
            'user_id' => $userId,
            'followed_id' => $id
        ];

        $data = $this->followRepository->createFollow($input);
        return redirect()->route('index', ['id' => $id])->with('message', 'You are now following this user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFollowRequest $request)
    {
        $userId = auth()->user()->id;

        if ($this->followRepository->getFollowByFollowedId($userId, $request->input('id'))) {
            if ($request->expectsJson()) {
                return response()->json(
                    [
                        'message' => 'The user already follows that person'
                    ],
                    Response::HTTP_CONFLICT
                );
            } else {
                return back()->withErrors('You already follow that person');
            }
        }

        $input = [
            'user_id' => $userId,
            'followed_id' => $request->input('id')
        ];

        $data = $this->followRepository->createFollow($input);

        if ($request->expectsJson()) {
            return response()->json(
                [
                    'data' => $data
                ],
                Response::HTTP_CREATED
            );
        } else {
            return redirect()->route('index', ['id' => $request->input('id')])->with('message', 'You are now following this user');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function followUsername(StoreFollowUsernameRequest $request)
    {
        $userId = auth()->user()->id;
        $user = User::where('username', $request->input('username'))->first();

        if (
            $user &&
            (
                $userId == $user->id ||
                $this->followRepository->getFollowByFollowedId($userId, $user->id)
            )
        ) {
            return back()->withErrors('You already follow that person');
        }

        $input = [
            'user_id' => $userId,
            'followed_id' => $user->id
        ];

        $data = $this->followRepository->createFollow($input);

        return redirect()->route('index', ['id' => $user->id])->with('message', 'You are now following this user');
    }

    /**
     * Following list
     *
     * @return \Illuminate\Http\Response
     */
    public function following()
    {
        return $this->followRepository->getUserFollowing(auth()->user()->id);
    }

    /**
     * Follower list
     *
     * @return \Illuminate\Http\Response
     */
    public function followers()
    {
        return $this->followRepository->getUserFollowers(auth()->user()->id);
    }
}
