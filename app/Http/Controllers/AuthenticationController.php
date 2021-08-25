<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function login(AuthenticationRequest $request) : JsonResponse
    {
        $collection = $request->safe()->collect();
        return response()->json(
            $this->authenticationService->login($collection)['response'],
            $this->authenticationService->login($collection)['status']
        );
    }

    public function logout() : JsonResponse
    {
        return response()->json($this->authenticationService->logout());
    }
}
