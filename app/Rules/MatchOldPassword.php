<?php

namespace App\Rules;

use Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchOldPassword implements Rule
{
    public function passes($attribute, $value)
    {
        if (Auth::guard('web')->user()) {
            return Hash::check($value, Auth::guard('web')->user()->password);

        } elseif (Auth::guard('Admin')->user()) {

            return Hash::check($value, Auth::guard('Admin')->user()->password);
        }
    }

    public function message()
    {
        return ':attribute must match with old password.';
    }
}
