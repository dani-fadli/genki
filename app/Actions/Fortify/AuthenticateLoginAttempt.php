<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateLoginAttempt
{
    /**
     * Define login process to replace Fortify default
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User|\Illuminate\Database\Eloquent\Model|void
     */
    public function __invoke(Request $request)
    {
        $user = User::query()->firstWhere('email', $request->email);
        if ($user && Hash::check($request->password, $user->password)) {
            return $user;
        }
    }
}
