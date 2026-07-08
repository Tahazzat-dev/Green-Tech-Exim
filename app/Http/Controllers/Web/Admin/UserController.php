<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
public function index(Request $request)
{
    $search = $request->search;

    $users = User::where('role', 'user')

        ->when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('shop_name', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%");

            });

        })

        ->latest()
        ->paginate(12)
        ->withQueryString();

    return view(
        'admin.users.index',
        compact('users')
    );
}

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'phone' => [
                'required',
                'unique:users',
            ],
            'shop_name' => ['required'],
            'city_area' => ['required'],

            'photo' => [
                'nullable',
                File::image()->max(2048),
            ],

            'pin' => [
                'required',
                'digits:4',
                'confirmed',
            ],

            // 'role' => [
            //     'required',
            //     'in:admin,user',
            // ],

            'status' => [
                'required',
                'in:pending,approved,blocked,rejected',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
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
            'plain_pin' => $validated['pin'],
            // 'role' => $validated['role'],
            'role' => "user",
            'discount' => $validated['discount'] ?? 0,
            'status' => $validated['status'],
            'device_id' => 'admin-'.uniqid(),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User created successfully.'
            );
    }

    public function show(User $user)
    {
        return view(
            'admin.users.show',
            compact('user')
        );
    }

    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }

    public function update(
        Request $request,
        User $user
    ) {

        $validated = $request->validate([
            'name' => ['required'],
            'phone' => [
                'required',
                'unique:users,phone,'.$user->id,
            ],

            'shop_name' => ['required'],
            'city_area' => ['required'],
            'status' => [
                'required',
                'in:pending,approved,blocked,rejected',
            ],

             'discount' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],

            'pin' => [
                'nullable',
                'digits:4',
            ],
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'shop_name' => $validated['shop_name'],
            'city_area' => $validated['city_area'],
            'discount' => $validated['discount'],
            'status' => $validated['status'],
        ];

        if ($request->filled('pin')) {
            $data['pin'] = Hash::make($request->pin);
            $data['plain_pin'] = $request->pin;
        }

        if ($request->hasFile('photo')) {

            $data['photo'] = $request
                ->file('photo')
                ->store('users', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User updated successfully.'
            );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}
