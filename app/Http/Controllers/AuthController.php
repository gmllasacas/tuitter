<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    public function test(Request $request): JsonResponse
    {
        return response()->json($request->input());
    }

    /**
     * Register a new user
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        );
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
            }

            return redirect()->route('login')->withErrors(['Invalid login details']);
        }

        $user = User::where('username', $request->input('username'))->firstOrFail();
        $request->session()->put('user', $user);

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($request->expectsJson()) {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return redirect()->route('index', ['id' => $user->id]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();
        }
        Auth::logout();
        return redirect()->route('login');
    }

    public function user(Request $request)
    {
        return new UserResource($request->user());
    }
}
