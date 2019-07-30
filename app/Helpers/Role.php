<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Role
{
    public static function getPermissions()
    {
        $user = Auth::user();
    }
}