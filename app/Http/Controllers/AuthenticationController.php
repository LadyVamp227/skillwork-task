<?php

namespace App\Http\Controllers;

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

    public function login(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }
        return response()->json(
            $this->authenticationService->login($request)['response'],
            $this->authenticationService->login($request)['status']
        );
    }

    public function logout() : JsonResponse
    {
        return response()->json($this->authenticationService->logout());
    }
}
