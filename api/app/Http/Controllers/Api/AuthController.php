<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    //
    public function authenticate(AuthRequest $request)
    {
        $email=$request->email;
        $password=$request->password;

        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password))
        {
            throw ValidationException::withMessages
            (
                [
                    'email'=>['Invalid login credentials']
                ]
            );
        }

        return
        [
            'user'=>$user,
            'token'=>$user->createToken('auth')->plainTextToken
        ];
    }
    public function register(StoreUserRequest $request) {
        $request->validated($request->all());

        $user = User::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of '. $user->first_name)->plainTextToken
        ]);
    }

}
