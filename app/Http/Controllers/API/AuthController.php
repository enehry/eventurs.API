<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use PasswordValidationRules;
    //
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|max:255',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'The credentials you entered did not match our records.',
                'errors' => [
                    'email' => 'The provided credentials are incorrect.',
                    'password' => 'The provided password is incorrect.'
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken($user->email)->plainTextToken;


        return response()->json([
            'message' => 'Login successful',
            'current_user' => $user,
            'access_token' => $token
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => $this->passwordRules(),
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json([
            'message' => 'User successfully created',
            'access_token' => $token
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful'
        ]);
    }
}
