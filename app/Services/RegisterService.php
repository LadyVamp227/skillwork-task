<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

final class RegisterService
{
    public function create(Collection $data) : string
    {
        $user = new User;
        $user->email = strtolower($data['email']);
        $user->name = $data['name'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $user->sendEmailVerificationNotification();
        return "ok";
    }
}
