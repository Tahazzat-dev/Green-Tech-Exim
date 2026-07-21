<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    private const ADMIN_2FA_USER_ID = 'admin_2fa_user_id';

    public function showLogin()
    {
        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.users.index');
            }

            return redirect()->route('categories.all');
        }

        return view('auth.admin-signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string'],
            'pin' => ['required', 'string'],
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (! $user || ! Hash::check($request->pin, $user->pin)) {
            return back()
                ->withErrors([
                    'pin' => 'Invalid phone number or PIN.',
                ])
                ->withInput();
        }

        if ($user->role !== 'admin') {
            return back()
                ->withErrors([
                    'phone' => 'This login page is for admin accounts only.',
                ])
                ->withInput($request->only('phone'));
        }

        if ($user->hasTwoFactorEnabled()) {
            $request->session()->regenerate();
            $request->session()->put(self::ADMIN_2FA_USER_ID, $user->id);

            return redirect()->route('admin.2fa.show');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.users.index');
    }

    public function showTwoFactor(Request $request)
    {
        if (! $this->hasAdminTwoFactorChallenge($request)) {
            return redirect()->route('admin.signin');
        }

        return view('auth.admin-two-factor');
    }

    public function verifyTwoFactor(Request $request, TwoFactorService $twoFactor)
    {
        $request->validate([
            'code' => [
                'required',
                'digits:6',
            ],
        ]);

        if (! $this->hasAdminTwoFactorChallenge($request)) {
            return redirect()->route('admin.signin');
        }

        $user = User::where('role', 'admin')
            ->findOrFail($request->session()->get(self::ADMIN_2FA_USER_ID));

        if (! $twoFactor->verify($user, $request->code)) {
            return back()
                ->withErrors([
                    'code' => 'Invalid authentication code.',
                ]);
        }

        $this->clearAdminTwoFactorChallenge($request);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.users.index');
    }

    public static function clearAdminTwoFactorChallenge(Request $request): void
    {
        $request->session()->forget(self::ADMIN_2FA_USER_ID);
    }

    private function hasAdminTwoFactorChallenge(Request $request): bool
    {
        return $request->session()->has(self::ADMIN_2FA_USER_ID);
    }
}
