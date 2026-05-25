<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
{
    $photo = null;

    if ($request->hasFile('photo')) {

        $photo = $request
            ->file('photo')
            ->store('users', 'public');
    }

    User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'shop_name' => $request->shop_name,
        'city_area' => $request->city_area,
        'photo' => $photo,
        'pin' => Hash::make($request->pin),
        'device_id' => $request->device_id,
        'status' => 'pending'
    ]);

    return response()->json([
        'message' =>
            'Registration successful. Waiting for approval.'
    ], 201);
}

public function login(LoginRequest $request)
{
    $user = User::where(
        'phone',
        $request->phone
    )->first();

    if (!$user) {

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    if ($user->status === 'pending') {

        return response()->json([
            'message' =>
            'Account pending approval'
        ], 403);
    }

    if ($user->status === 'blocked') {

        return response()->json([
            'message' =>
            'Account blocked'
        ], 403);
    }

    if ($user->status === 'rejected') {

        return response()->json([
            'message' =>
            'Account rejected'
        ], 403);
    }

    if (
        !Hash::check(
            $request->pin,
            $user->pin
        )
    ) {

        return response()->json([
            'message' =>
            'Invalid credentials'
        ], 401);
    }

    if (
        $user->device_id !==
        $request->device_id
    ) {

        return response()->json([
            'message' =>
            'Device not authorized'
        ], 403);
    }

    $token = $user
        ->createToken('mobile')
        ->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user
    ]);
}

public function logout(Request $request)
{
    $request
        ->user()
        ->currentAccessToken()
        ->delete();

    return response()->json([
        'message' => 'Logged out'
    ]);
}
}
