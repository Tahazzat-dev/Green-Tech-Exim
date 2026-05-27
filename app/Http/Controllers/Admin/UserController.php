<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function approve(User $user)
    {
        $user->update([
            'status' => 'approved',
        ]);

        return back();
    }
}
