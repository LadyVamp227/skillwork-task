<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    private $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(RegisterRequest $request) : JsonResponse
    {
        $collection = $request->safe()->collect();
        return response()->json($this->registerService->create($collection));
    }
}
