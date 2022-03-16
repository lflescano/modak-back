<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseCodes;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

use DB;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response($validator->errors(), ResponseCodes::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Register User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            'name' => 'required|string|max:100',
            'password' => ['required',
                            'string',
                            'confirmed',
                            'min:8',
                            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ]
        ],
        [
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas deben coincidir',
            'password.min' => 'La contraseña debe contener al menos 8 caracteres',
            'password.regex' => 'La contraseña debe tener una mayúscula, una minúscula y un número'
        ]
        );

        if($validator->fails()){
            return response()->json($validator->errors(), ResponseCodes::HTTP_UNPROCESSABLE_ENTITY);
        }

        $userExists = User::where('email', trim($request->email))->first();

        if($userExists){
            return response()->json(['error' => 'User already exists'], ResponseCodes::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = DB::transaction(function () use ($request, $validator){
            $user = User::create(array_merge(
                        $validator->validated(),
                        ['password' => bcrypt($request->password)]
                    ));

            return $user;
        }, 5);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}