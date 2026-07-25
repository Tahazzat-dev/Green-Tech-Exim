<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private const ADMIN_DENIED_MESSAGE = 'This account is not allowed on the mobile app.';

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
            'discount' => 0,
            'pin' => Hash::make($request->pin),
            'plain_pin' => $request->pin,
            'device_id' => $request->device_id,
            'device_change_allowed' => false,
            'role' => 'user',
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Registration successful. Waiting for approval.',
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where(
            'phone',
            $request->phone
        )->first();

        if (! $user) {

            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        if ($user->role !== 'user') {

            return response()->json([
                'message' => self::ADMIN_DENIED_MESSAGE,
            ], 403);
        }

        if ($user->status === 'pending') {

            return response()->json([
                'message' => 'Account pending approval',
            ], 403);
        }

        if ($user->status === 'blocked') {

            return response()->json([
                'message' => 'Account blocked',
            ], 403);
        }

        if ($user->status === 'rejected') {

            return response()->json([
                'message' => 'Account rejected',
            ], 403);
        }

        if (
            ! Hash::check(
                $request->pin,
                $user->pin
            )
        ) {

            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        if (
            $user->device_id &&
            $user->device_id !== $request->device_id &&
            ! $user->device_change_allowed
        ) {

            return response()->json([
                'message' => 'Device not authorized',
            ], 403);
        }

        $token = DB::transaction(function () use ($request, $user) {
            if (! $user->device_id) {

                $user->forceFill([
                    'device_id' => $request->device_id,
                    'device_change_allowed' => false,
                ])->save();

            } elseif ($user->device_id !== $request->device_id) {

                $user->tokens()->delete();

                $user->forceFill([
                    'device_id' => $request->device_id,
                    'device_change_allowed' => false,
                ])->save();
            }

            return $user
                ->createToken('mobile')
                ->plainTextToken;
        });

        $user->refresh();

        return response()->json([
            'token' => $token,
            'user' => $this->userPayload($user),
        ]);
    }

    public function me(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'user') {

            return response()->json([
                'message' => self::ADMIN_DENIED_MESSAGE,
            ], 403);
        }

        return response()->json($this->userPayload($user));
    }

    private function userPayload(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'shop_name' => $user->shop_name,
            'city_area' => $user->city_area,
            'photo' => $user->photo,
            'photo_url' => $this->photoUrl($user->photo),
            'status' => $user->status,
            'discount' => $user->discount ?? 0,
            'device_id' => $user->device_id,
            'device_change_allowed' => (bool) $user->device_change_allowed,
        ];
    }

    public function logout(Request $request)
    {
        $request
            ->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }

    private function photoUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return asset('storage/'.$path);
    }
}
