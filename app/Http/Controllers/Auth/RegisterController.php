<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'access_level' => 'required|string|in:recepcionista,medico',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $registerData = $request->only('name', 'email', 'password', 'access_level');

        $registerData['password'] = bcrypt($registerData['password']);

        if (!$user = $user->create($registerData))
            abort(500, 'Erro ao criar um novo usuário!');

        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);
    }
}
