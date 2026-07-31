<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class UserController extends Controller
{
    // public function show(Product $product)
    public function showExecutives()
    {
        $contacts = Contact::where('status', true)
            ->latest()
            ->get();

        return view(
            'users.contacts',
            compact('contacts')
        );
    }
}
