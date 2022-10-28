<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\RegisterRequest;
use App\UseCases\User\RegisterAction;
use App\Http\Requests\User\LoginRequest;
use App\UseCases\User\LoginAction;
use App\UseCases\User\LogoutAction;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $action)
    {
        $data = $request->makeUser();
        return new UserResource($action($data));
    }

    public function login(LoginRequest $request, LoginAction $action)
    {
        $data = $request->makeUser();
        $token = $action($data);
        if ($token) {
            return new UserResource($token);
        } else {
            $responseBody = array('message' => 'Invalid login details');
            $responseCode = 401;
            return response($responseBody, $responseCode)
                ->header('Content-Type', 'application/json');
        }
    }
    public function logout(LogoutAction $action)
    {
        if (Auth::guard('sanctum')->user()) {
            $action(Auth::guard('sanctum')->user());
            $responseBody = array('message' => 'ok');
            $responseCode = 200;
        } else {
            $responseBody = array('message' => 'Not logged in');
            $responseCode = 400;
        }
        
        return response($responseBody, $responseCode)
            ->header('Content-Type', 'application/json');
    }
}
