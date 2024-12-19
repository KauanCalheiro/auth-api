<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController {
    const TOKEN_NAME = 'Personal Access Token';
    const REGISTER_ERROR_BAG = 'register';
    const REGISTER_VALIDATION = [
        'name' => 'required|string',
        'email' => 'required|string|unique:users',
        'password' => 'required|string',
        'c_password' => 'required|same:password',
    ];

    const LOGIN_ERROR_BAG = 'login';
    const LOGIN_VALIDATION = [
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean',
    ];

    const TOKEN_TYPE = 'Bearer';



    /**
     * Create user
     *
     * @api POST /api/auth/register
     *
     * @body {
     *  "name":       "string",
     *  "email":      "string",
     *  "password":   "string",
     *  "c_password": "string"
     * }
     * 
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-12-18
     */
    public function register(Request $request) {
        $request->validateWithBag(
            self::REGISTER_ERROR_BAG,
            self::REGISTER_VALIDATION
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $expires = now()->addDay();

        return response()->json([
            'message' => 'Successfully created user!',
            'access_token' => $user->createToken(self::TOKEN_NAME, ['*'], $expires)->plainTextToken,
            'token_type' => self::TOKEN_TYPE,
            'expires_at' => $expires->toDateTimeString(),
        ], 201);
    }

    /**
     * Get the authenticated User
     *
     * @api POST /api/auth/user
     * 
     * @body {
     *  "email":       "string",
     *  "password":    "string",
     *  "remember_me": "boolean"
     * }
     * 
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *  
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-12-18
     */
    public function login(Request $request) {
        $request->validateWithBag(
            self::LOGIN_ERROR_BAG,
            self::LOGIN_VALIDATION
        );

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        $expires = $request->remember_me ? now()->addMonth() : now()->addDay();

        return response()->json([
            'message' => 'Successfully logged in',
            'access_token' => Auth::user()->createToken(self::TOKEN_NAME, ['*'], $expires)->plainTextToken,
            'token_type' => self::TOKEN_TYPE,
            'expires_at' => $expires->toDateTimeString(),
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @api GET /api/auth/user
     * 
     * @header Authorization: Bearer {token}
     * 
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-12-18
     */
    public function user(Request $request) {
        return response()->json($request->user());
    }


    /**
     * Log the user out (Invalidate the token)
     *
     * @api GET /api/auth/logout
     * 
     * @header Authorization: Bearer {token}
     * 
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @author Kauan Morinel Calheiro <kauan.calheiro@univates.br>
     *
     * @date 2024-12-18
     */
    public function logout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
