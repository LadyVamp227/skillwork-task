<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class AuthenticationService
{
    /**
     * @param $data
     * @return array
     */
    public function login($data) : Collection
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return collect(['response' => 'Invalid email or password', 'status' => 422]);
        }
        $token = $user->createToken('authToken')->plainTextToken;

        return collect(['response' => ['access_token' => $token, 'token_type' => 'Bearer', 'user' => $user], 'status' => 200]);
    }

    /**
     * @return string
     */

    public function logout() : string
    {
        $token = Auth::user()->tokens();
        $token->delete();
        return 'You have been successfully logged out!';
    }
}
