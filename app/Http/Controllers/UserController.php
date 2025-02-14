<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function register(RegisterUserRequest $request)
    {
        $password = password_hash($request->password, PASSWORD_DEFAULT);
        $request['role_id'] = 2;
        $request['password'] = $password;
        $user = User::create($request->all());

        return redirect('/');
    }
}
