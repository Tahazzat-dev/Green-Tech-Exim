<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\PrivacyPolicy;
use App\Services\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SettingController extends Controller
{
    private const TWO_FACTOR_SETUP_SECRET = 'two_factor_setup_secret';

    public function edit(Request $request, TwoFactorService $twoFactor)
    {
        $settings = AppSetting::current();
        $privacyPolicy = PrivacyPolicy::current();
        $user = $request->user();
        $twoFactorSetupActive = $request->session()->has(self::TWO_FACTOR_SETUP_SECRET);
        $twoFactorQrSvg = null;

        if ($twoFactorSetupActive) {
            $secret = Crypt::decryptString(
                $request->session()->get(self::TWO_FACTOR_SETUP_SECRET)
            );
            $twoFactorQrSvg = $twoFactor->getQrCodeSvg($user, $secret);
        }

        return view(
            'admin.settings.edit',
            compact(
                'settings',
                'privacyPolicy',
                'user',
                'twoFactorSetupActive',
                'twoFactorQrSvg'
            )
        );
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'whatsapp_phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'facebook_page_url' => [
                'nullable',
                'url',
                'max:255',
            ],
            'app_download_url' => [
                'nullable',
                'url',
                'max:255',
            ],
        ]);

        AppSetting::current()->update($validated);

        return back()
            ->with('success', 'Settings updated successfully.');
    }

    public function updatePrivacyPolicy(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'content' => [
                'required',
                'string',
            ],
        ]);

        PrivacyPolicy::current()->update($validated);

        return back()
            ->with('privacy_success', 'Privacy policy updated successfully.');
    }

    public function enableTwoFactor(Request $request, TwoFactorService $twoFactor)
    {
        $user = $request->user();

        if ($user->hasTwoFactorEnabled()) {
            return back()
                ->with('two_factor_error', 'Two-factor authentication is already enabled.');
        }

        $secret = $twoFactor->generateSecret();

        $request->session()->put(
            self::TWO_FACTOR_SETUP_SECRET,
            Crypt::encryptString($secret)
        );

        return back()
            ->with('two_factor_setup', true);
    }

    public function confirmTwoFactor(Request $request, TwoFactorService $twoFactor)
    {
        $request->validate([
            'code' => [
                'required',
                'digits:6',
            ],
        ]);

        if (! $request->session()->has(self::TWO_FACTOR_SETUP_SECRET)) {
            return back()
                ->with('two_factor_error', 'Two-factor setup expired. Please start again.');
        }

        $secret = Crypt::decryptString(
            $request->session()->get(self::TWO_FACTOR_SETUP_SECRET)
        );

        if (! $twoFactor->verifySecret($secret, $request->code)) {
            return back()
                ->with('two_factor_setup', true)
                ->withErrors([
                    'two_factor_code' => 'Invalid authentication code. Try again.',
                ]);
        }

        $request->user()->update([
            'two_factor_secret' => Crypt::encryptString($secret),
            'two_factor_enabled' => true,
        ]);

        $request->session()->forget(self::TWO_FACTOR_SETUP_SECRET);

        return back()
            ->with('two_factor_success', 'Two-factor authentication has been enabled.');
    }

    public function cancelTwoFactorSetup(Request $request)
    {
        $request->session()->forget(self::TWO_FACTOR_SETUP_SECRET);

        return back()
            ->with('two_factor_success', 'Two-factor setup cancelled.');
    }

    public function disableTwoFactor(Request $request, TwoFactorService $twoFactor)
    {
        $request->validate([
            'code' => [
                'required',
                'digits:6',
            ],
        ]);

        $user = $request->user();

        if (! $user->hasTwoFactorEnabled()) {
            return back()
                ->with('two_factor_error', 'Two-factor authentication is not enabled.');
        }

        if (! $twoFactor->verify($user, $request->code)) {
            return back()
                ->withErrors([
                    'disable_two_factor_code' => 'Invalid authentication code.',
                ]);
        }

        $user->update([
            'two_factor_secret' => null,
            'two_factor_enabled' => false,
        ]);

        return back()
            ->with('two_factor_success', 'Two-factor authentication has been disabled.');
    }
}
