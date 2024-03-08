<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symphony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {

        try {
            $validator = Validator::make(request()->all(), [
                "email" => "required|email",
                "password" => "required"
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $credentials = request(['email', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user = auth()->user();

            // Verificar si el usuario está activo
            if (!$user->activo) {
                return response()->json(['error' => 'Unauthorized: User is not active'], 401);
            }

            return $this->respondWithToken([
                'token' => $token,
                'user' => $user
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ]);
        }
    }
}
