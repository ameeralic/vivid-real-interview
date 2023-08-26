<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->can('admin')) {
                $token = $user->createToken('admin-token', ['create', 'update', 'delete']);
            } else {
                $token = $user->createToken('general-token', ['create', 'update', 'delete']);
            }

            return response()->json([
                'message' => 'login Success!',
                'token' => $token->plainTextToken,
            ]);

        } else {
            return response()->json([
                'message' => 'login failed!',
            ]);
        }
    }
}
