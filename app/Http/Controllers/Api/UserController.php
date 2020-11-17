<?php

namespace App\Http\Controllers;

use Hash;
use app\User;

class UserController extends Controllers
{
    public function index(Request $request)
    {
        

        $user = User::query();
    }
}

