<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignin()
    {
        return view('auth.signin');
    }
    public function signin(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'pin' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        // Ensure user exists, is an Admin, and matches PIN hashes
        if (! $user || $user->role !== 'admin' || ! Hash::check($request->pin, $user->pin)) {
            return back()->withErrors(['phone' => 'Invalid administrative credentials.'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }


     public function showSignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        dd($request->all());

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
                'unique:users,phone',
            ],

            'shop_name' => [
                'required',
                'string',
                'max:255',
            ],

            'city_area' => [
                'required',
                'string',
                'max:255',
            ],

            'photo' => [
                'nullable',
                File::image()
                    ->max(2 * 1024), // 2MB
            ],

            'pin' => [
                'required',
                'digits:4',
                'confirmed',
            ],
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request
                ->file('photo')
                ->store('users', 'public');
        }

        User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'shop_name' => $validated['shop_name'],
            'city_area' => $validated['city_area'],
            'photo' => $photoPath,
            'pin' => Hash::make($validated['pin']),

            // web registration
            'device_id' => 'web-' . uniqid(),

            // waiting for admin approval
            'status' => 'pending',
        ]);

        return redirect()
            ->route('signin')
            ->with(
                'success',
                'Registration submitted successfully. Please wait for admin approval.'
            );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
