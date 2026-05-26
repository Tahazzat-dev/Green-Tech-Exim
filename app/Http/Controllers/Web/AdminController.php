<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'pending_users' => User::where('status', 'pending')->count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function usersIndex(Request $request)
    {
        // Fetch users filtering out admin profiles
        $users = User::where('role', '!=', 'admin')
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,disabled'
        ]);

        $user->update(['status' => $request->status]);

        return back()->with('success', "User status updated to {$request->status} successfully.");
    }

    public function resetDevice(User $user)
    {
        // Wipe old device fingerprint so mobile app can claim new ID next login
        $user->update([
            'device_id' => null,
            'status' => 'pending' // Re-route to pending verification block state 
        ]);

        return back()->with('success', "Device lock released. User account set back to pending for new registration verification.");
    }
}