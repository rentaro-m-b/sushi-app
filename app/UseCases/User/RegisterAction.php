<?php

namespace App\UseCases\User;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterAction
{
    public function __invoke(User $user)
    {
        assert($user->exists);
        $user['password'] = Hash::make($user['password']);
        $user->save();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }
}
