<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Dto\RegisterInfoDto;
use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;

class AuthController extends BaseApiController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register(new RegisterInfoDto($request->name, $request->email, $request->password));

        return $this->successResponse($data);
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->email, $request->password);
        return $this->successResponse($data);
    }


}
