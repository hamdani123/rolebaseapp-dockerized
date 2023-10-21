<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refreshToken']]);
    }

    public function getAuthUserData(Request $request): JsonResponse
    {
        $authService = new AuthService();

        $authService->getAuthInfo(auth()->user());

        return $this->sendApiResponse(
            $authService->code,
            $authService->result,
            $authService->message
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {

        $inputData = $request->all();

        $authService = new AuthService();

        $authService->getTokenByCredential(
            $inputData['email'],
            $inputData['password']
        );

        return $this->sendApiResponse(
            $authService->code,
            $authService->result,
            $authService->message
        );

    }
}
