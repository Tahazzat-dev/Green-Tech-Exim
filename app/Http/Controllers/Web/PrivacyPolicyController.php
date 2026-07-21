<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function show()
    {
        $privacyPolicy = PrivacyPolicy::current();

        return view(
            'privacy-policy.show',
            compact('privacyPolicy')
        );
    }
}
