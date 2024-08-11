<?php

namespace App\Http\Controllers\BouthSystem\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request = $request->only('email', 'password');

        if (!auth()->attempt($request)) abort(401, 'Dados não conferem');

        $user = User::where('email', $request['email'])->first();

        return response()->json([
           'message' => 'Bem vindo '.$user['name'],
           'user' => $user ,
            'token' => auth()->user()->createToken($request['email'])->plainTextToken
        ]);
    }
}
