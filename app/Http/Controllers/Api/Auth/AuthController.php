<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;
    // POST /api/login
    public function login(Request $request)
    {
        $credentials = $request->except(['_token', '_method', '_csrfToken', 'checkbox-fill-a1', 'checkbox-fill-1']);
        $validatorRequest = new LoginRequest();
        $validator = Validator::make($credentials, $validatorRequest->rules(), $validatorRequest->messages(), $validatorRequest->attributes());

        try {
            if (Auth::attempt($credentials)) {
                if(auth()->user()->active == 1){
                    $user = $request->user();

                    // Revocar tokens viejos si quieres
                    $user->tokens()->delete();

                    // Crear nuevo token
                    $newToken = $user->createToken('angular-panel');
                    $plainTextToken = $newToken->plainTextToken;

                    // Intentar obtener abilities del token (si existen)
                    $abilities = [];
                    if (isset($newToken->accessToken) && isset($newToken->accessToken->abilities)) {
                        $abilities = $newToken->accessToken->abilities;
                    }

                    // Recolectar roles y permisos del usuario
                    $roles = $user->getRoleNames()->toArray();
                    $permissions = $user->getAllPermissions()->pluck('name')->toArray();

                    // Construir payload de usuario con campos relevantes
                    $userPayload = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        // campos opcionales si existen en el modelo
                        'first_name' => $user->first_name ?? null,
                        'second_name' => $user->second_name ?? null,
                        'first_last_name' => $user->first_last_name ?? null,
                        'second_last_name' => $user->second_last_name ?? null,
                        'phone' => $user->phone ?? null,
                        'active' => $user->active ?? null,
                        'imagen' => $user->imagen ?? null,
                        'roles' => $roles,
                        'permissions' => $permissions,
                        'lang' => $user->lang ?? "en",
                    ];

                    return $this->successResponse([
                        'success' => true,
                        'token'   => $plainTextToken,
                        'token_type' => 'Bearer',
                        'abilities' => $abilities,
                        'user'    => $userPayload,
                    ], Lang::get('Session started'), 200);
                }else{
                    Session::flush();
                    auth()->guard('api')->logout();
                    return $this->errorResponse(Lang::get('The user is inactive'), "", 401);
                }
            }else{
                return $this->errorResponse(Lang::get('The username or password is incorrect'), "", 401);
            }
        } catch (\Throwable $th) {
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 401);
        }
    }

    // POST /api/logout
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->successResponse([], Lang::get('Closed session'), 200);
        } catch (\Throwable $th) {
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 401);
        }
    }

    // GET /api/me
    public function me(Request $request)
    {
        try {
            return $this->successResponse(['user'    => $request->user()], Lang::get('Closed session'), 200);
        } catch (\Throwable $th) {
            return $this->errorResponse(Lang::get('There was an error, try again'), "", 401);
        }
    }
    // GET /api/
    public function login_fall()
    {
        return $this->errorResponse(Lang::get('Unauthorized'), "", 401);
    }
}
