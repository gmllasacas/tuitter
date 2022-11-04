<?php

namespace App\Http\Controllers;

use App\Interfaces\TweetRepositoryInterface;
use App\Http\Requests\StoreTweetRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Resources\TweetResource;
use App\Http\Resources\TweetCollection;

class TweetController extends Controller
{
    private TweetRepositoryInterface $tweetRepository;

    public function __construct(TweetRepositoryInterface $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    /**
     * Display the create tweet form
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function index()
    {
        return view(
            'tweet'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     */
    public function store(StoreTweetRequest $request)
    {
        $input = [
            'user_id' => auth()->user()->id,
            'body' => strip_tags($request->input('body'))
        ];

        $data = $this->tweetRepository->createTweet($input);

        if ($request->expectsJson()) {
            return response()->json(
                [
                    'data' => $data
                ],
                Response::HTTP_CREATED
            );
        } else {
            return redirect()->route('index', ['id' => auth()->user()->id])->with('message', 'The tweet was posted');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function feed()
    {
        $following = auth()->user()->following->map->only(['followed_id']);

        $usersId = array_merge(
            [auth()->user()->id],
            array_column($following->toArray(), 'followed_id')
        );
        return $this->tweetRepository->getUserTweets($usersId);
    }
}
