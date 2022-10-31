<?php

namespace App\UseCases\User;

class LogoutAction
{
    public function __invoke($user)
    {
        $user->tokens()->delete();
    }
}
