<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {

            return response()->json([
                'message' => 'Credenciais inválidas!',
                'statusTexts' => Response::$statusTexts[Response::HTTP_UNAUTHORIZED],
                'status' => Response::HTTP_UNAUTHORIZED
            ])->setStatusCode(Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);
        }

        $token = auth()->user()->createToken('auth_token');

        return response()->json([
            'message' => 'Login efetuado com sucesso!',
            'data' => [
                'token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                ],
        ], Response::HTTP_OK);
    }
    public function user(Request $request)
    {
        $user = auth()->user();

        return response()->json($user, 200);
    }
    public function logout()
    {
        //auth()->user()->tokens()->delete(); //delete all tokens of user

        auth()->user()->currentAccessToken()->delete();

        return response()->json([], 204);
    }
}
