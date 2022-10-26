<?php

namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function __invoke(User $user)
    {
        assert($user->exists);
        if (Auth::attempt($user->only('name', 'password'))) {
            $user = User::where('name', $user['name'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
        } else {
            $token = null;
        }
        return $token;
    }
}
