<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Services\Contracts\AesDecryptionServiceInterface;
use App\Services\Contracts\TwoFactorServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly AesDecryptionServiceInterface $aes,
        private readonly TwoFactorServiceInterface $twoFactor,
    ) {}

    /**
     * Iniciar sesión
     *
     * Autentica al usuario con sus credenciales y devuelve un Bearer Token de Sanctum.
     * Si el usuario tiene 2FA activo, el campo `requires_2fa` será `true` y deberá
     * verificarse en `POST /api/2fa/verify` antes de acceder a recursos protegidos.
     *
     * @group Autenticación
     * @unauthenticated
     *
     * @bodyParam email string required Correo electrónico registrado. Example: usuario@ejemplo.com
     * @bodyParam password string required Contraseña encriptada en AES-256-CBC (CryptoJS). No envíar en texto plano. Example: U2FsdGVkX1+abc123...
     *
     * @response 200 scenario="Sesión iniciada" {
     *   "success": true,
     *   "message": "Sesión iniciada correctamente",
     *   "data": {
     *     "token": "1|aBcDeFgHiJkLmN...",
     *     "token_type": "Bearer",
     *     "requires_2fa": false,
     *     "user": {
     *       "id": 1,
     *       "name": "Juan Pérez",
     *       "email": "usuario@ejemplo.com",
     *       "first_name": "Juan",
     *       "second_name": null,
     *       "first_last_name": "Pérez",
     *       "second_last_name": null,
     *       "phone": "****",
     *       "phone_ext": null,
     *       "active": 1,
     *       "imagen": null,
     *       "lang": "es",
     *       "has_2fa": false,
     *       "roles": ["User"],
     *       "permissions": ["ver-usuarios"]
     *     }
     *   }
     * }
     * @response 200 scenario="2FA requerido" {
     *   "success": true,
     *   "message": "Sesión iniciada correctamente",
     *   "data": {
     *     "token": "2|xYzAbC...",
     *     "token_type": "Bearer",
     *     "requires_2fa": true,
     *     "user": { "id": 2, "name": "María López", "email": "maria@ejemplo.com" }
     *   }
     * }
     * @response 401 scenario="Credenciales incorrectas" {
     *   "success": false,
     *   "message": "Las credenciales son incorrectas",
     *   "errors": ""
     * }
     * @response 401 scenario="Usuario inactivo" {
     *   "success": false,
     *   "message": "El usuario se encuentra inactivo",
     *   "errors": ""
     * }
     * @response 422 scenario="Validación fallida" {
     *   "success": false,
     *   "message": "Los datos proporcionados no son válidos",
     *   "errors": { "email": ["El correo electrónico es obligatorio."] }
     * }
     * @response 429 scenario="Demasiados intentos" {
     *   "message": "Too Many Requests"
     * }
     */
    public function login(LoginRequest $request)
    {
        try {
            $plainPassword = $this->aes->decrypt($request->input('password'));

            $credentials = [
                'email'    => $request->input('email'),
                'password' => $plainPassword,
            ];

            if (!Auth::attempt($credentials)) {
                return $this->errorResponse(__('messages.auth.credentials_incorrect'), '', 401);
            }

            /** @var User $user */
            $user = Auth::user();

            if ($user->active != 1) {
                Auth::logout();
                return $this->errorResponse(__('messages.auth.user_inactive'), '', 401);
            }

            // Revocar tokens anteriores
            $user->tokens()->delete();

            $newToken       = $user->createToken('angular-panel');
            $plainTextToken = $newToken->plainTextToken;

            $requires2fa = $this->twoFactor->isEnabled($user);

            return $this->successResponse([
                'token'        => $plainTextToken,
                'token_type'   => 'Bearer',
                'requires_2fa' => $requires2fa,
                'user'         => $this->buildUserPayload($user),
            ], __('messages.auth.session_started'), 200);

        } catch (\RuntimeException $e) {
            return $this->errorResponse(__('messages.auth.credentials_incorrect'), '', 401);
        } catch (\Throwable) {
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Registrar nuevo usuario
     *
     * Crea una nueva cuenta de usuario en el sistema. El usuario recibe automáticamente
     * el rol `User` y un Bearer Token listo para usar.
     * La contraseña debe enviarse encriptada en AES-256-CBC.
     *
     * @group Autenticación
     * @unauthenticated
     *
     * @bodyParam document string required Número de documento de identidad (único, máx. 20 caracteres). Example: 12345678
     * @bodyParam first_name string required Primer nombre (máx. 100 caracteres). Example: Juan
     * @bodyParam second_name string Segundo nombre (opcional, máx. 100 caracteres). Example: Carlos
     * @bodyParam first_last_name string required Primer apellido (máx. 100 caracteres). Example: Pérez
     * @bodyParam second_last_name string Segundo apellido (opcional, máx. 100 caracteres). Example: Gómez
     * @bodyParam email string required Correo electrónico válido y único (último máx. 255 caracteres). Example: nuevo@ejemplo.com
     * @bodyParam password string required Contraseña encriptada AES-256-CBC (mínimo 8 caracteres, 1 mayúscula, 1 número, 1 especial). Example: U2FsdGVkX1+xyz...
     * @bodyParam phone string required Teléfono en formato E.164 (ej: +573001234567). Example: +573001234567
     * @bodyParam phone_ext numeric Extensión telefónica (opcional, 1-10 dígitos). Example: 101
     * @bodyParam birth_day string required Fecha de nacimiento en formato YYYY-MM-DD. Debe ser mayor de 18 años. Example: 1990-05-15
     *
     * @response 201 scenario="Usuario creado" {
     *   "success": true,
     *   "message": "Usuario registrado exitosamente",
     *   "data": {
     *     "token": "3|pQrStUvW...",
     *     "token_type": "Bearer",
     *     "user": {
     *       "id": 5,
     *       "name": "Juan Pérez",
     *       "email": "nuevo@ejemplo.com",
     *       "first_name": "Juan",
     *       "second_name": "Carlos",
     *       "first_last_name": "Pérez",
     *       "second_last_name": "Gómez",
     *       "phone": "****",
     *       "active": 1,
     *       "lang": "es",
     *       "has_2fa": false,
     *       "roles": ["User"],
     *       "permissions": []
     *     }
     *   }
     * }
     * @response 422 scenario="Validación fallida" {
     *   "success": false,
     *   "message": "Los datos proporcionados no son válidos",
     *   "errors": { "email": ["El correo electrónico ya está registrado."] }
     * }
     * @response 429 scenario="Demasiados intentos" {
     *   "message": "Too Many Requests"
     * }
     */
    public function register(RegisterRequest $request)
    {
        try {
            $plainPassword = $this->aes->decrypt($request->input('password'));

            $user = User::create([
                'document'         => $request->input('document'),
                'first_name'       => $request->input('first_name'),
                'second_name'      => $request->input('second_name'),
                'first_last_name'  => $request->input('first_last_name'),
                'second_last_name' => $request->input('second_last_name'),
                'email'            => $request->input('email'),
                'password'         => Hash::make($plainPassword),
                'phone'            => $request->input('phone'),
                'phone_ext'        => $request->input('phone_ext'),
                'birth_day'        => $request->input('birth_day'),
                'lang'             => 'es',
                'active'           => 1,
            ]);

            $user->assignRole('User');

            $token = $user->createToken('angular-panel')->plainTextToken;

            return $this->successResponse([
                'token'      => $token,
                'token_type' => 'Bearer',
                'user'       => $this->buildUserPayload($user),
            ], __('messages.auth.user_registered'), 201);

        } catch (\RuntimeException $e) {
            return $this->errorResponse($e->getMessage(), '', 422);
        } catch (\Throwable) {
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Recuperar contraseña
     *
     * Envía un enlace de recuperación al correo registrado.
     * La respuesta es genérica para no revelar si el email existe en el sistema.
     *
     * @group Autenticación
     * @unauthenticated
     *
     * @bodyParam email string required Correo electrónico asociado a la cuenta. Example: usuario@ejemplo.com
     *
     * @response 200 scenario="Enlace enviado" {
     *   "success": true,
     *   "message": "Si el correo está registrado, recibirás un enlace de recuperación",
     *   "data": []
     * }
     * @response 422 scenario="Validación fallida" {
     *   "success": false,
     *   "message": "Los datos proporcionados no son válidos",
     *   "errors": { "email": ["El correo electrónico es obligatorio."] }
     * }
     * @response 429 scenario="Demasiados intentos" {
     *   "message": "Too Many Requests"
     * }
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        // Respuesta genérica para no revelar si el email existe en la BD
        Password::sendResetLink($request->only('email'));

        return $this->successResponse(
            [],
            __('messages.auth.forgot_password_sent'),
            200
        );
    }

    /**
     * Restablecer contraseña
     *
     * Restablece la contraseña del usuario usando el token enviado por correo.
     * Todos los tokens de sesión son invalidados tras el reset exitoso.
     * La nueva contraseña debe enviarse encriptada en AES-256-CBC.
     *
     * @group Autenticación
     * @unauthenticated
     *
     * @bodyParam email string required Correo electrónico de la cuenta. Example: usuario@ejemplo.com
     * @bodyParam token string required Token de recuperación recibido por correo. Example: a1b2c3d4e5f6...
     * @bodyParam password string required Nueva contraseña encriptada AES-256-CBC. Example: U2FsdGVkX1+newpass...
     *
     * @response 200 scenario="Contraseña restablecida" {
     *   "success": true,
     *   "message": "Contraseña restablecida exitosamente",
     *   "data": []
     * }
     * @response 422 scenario="Token inválido o expirado" {
     *   "success": false,
     *   "message": "El token de recuperación es inválido o ha expirado",
     *   "errors": ""
     * }
     * @response 422 scenario="Validación fallida" {
     *   "success": false,
     *   "message": "Los datos proporcionados no son válidos",
     *   "errors": { "token": ["El token es obligatorio."] }
     * }
     * @response 429 scenario="Demasiados intentos" {
     *   "message": "Too Many Requests"
     * }
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $plainPassword = $this->aes->decrypt($request->input('password'));

            $status = Password::reset(
                [
                    'email'    => $request->input('email'),
                    'token'    => $request->input('token'),
                    'password' => $plainPassword,
                ],
                function (User $user, string $password) {
                    $user->password = Hash::make($password);
                    $user->save();

                    // Invalidar todos los tokens de sesión tras el reset
                    $user->tokens()->delete();
                }
            );

            if ($status !== Password::PasswordStatus::PasswordReset) {
                return $this->errorResponse(
                    __('messages.auth.reset_token_invalid'),
                    '',
                    422
                );
            }

            return $this->successResponse([], __('messages.auth.password_reset_success'), 200);

        } catch (\RuntimeException $e) {
            return $this->errorResponse($e->getMessage(), '', 422);
        } catch (\Throwable) {
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Cerrar sesión
     *
     * Invalida el token de acceso actual del usuario autenticado.
     * Para cerrar todas las sesiones activas en todos los dispositivos,
     * usar el endpoint de eliminación de todos los tokens.
     *
     * @group Autenticación
     *
     * @response 200 scenario="Sesión cerrada" {
     *   "success": true,
     *   "message": "Sesión cerrada correctamente",
     *   "data": []
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->successResponse([], __('messages.auth.session_closed'), 200);
        } catch (\Throwable) {
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Obtener usuario autenticado
     *
     * Retorna los datos del usuario actualmente autenticado, incluyendo
     * sus roles, permisos y estado del 2FA.
     *
     * @group Autenticación
     *
     * @response 200 scenario="Datos del usuario" {
     *   "success": true,
     *   "message": "Sesión iniciada correctamente",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "Juan Pérez",
     *       "email": "usuario@ejemplo.com",
     *       "first_name": "Juan",
     *       "second_name": null,
     *       "first_last_name": "Pérez",
     *       "second_last_name": null,
     *       "phone": "****",
     *       "phone_ext": null,
     *       "active": 1,
     *       "imagen": null,
     *       "lang": "es",
     *       "has_2fa": false,
     *       "roles": ["Admin"],
     *       "permissions": ["ver-usuarios", "crear-usuarios"]
     *     }
     *   }
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function me(Request $request)
    {
        try {
            /** @var User $user */
            $user = $request->user();
            return $this->successResponse(['user' => $this->buildUserPayload($user)], __('messages.auth.session_started'), 200);
        } catch (\Throwable) {
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    // GET /api/  — fallback sin autenticación
    public function login_fall()
    {
        return $this->errorResponse(__('messages.auth.unauthorized'), '', 401);
    }

    // ---------------------------------------------------------------------------
    // Helpers privados
    // ---------------------------------------------------------------------------

    private function buildUserPayload(User $user): array
    {
        return [
            'id'               => $user->id,
            'name'             => trim("{$user->first_name} {$user->first_last_name}"),
            'email'            => $user->email,
            'first_name'       => $user->first_name,
            'second_name'      => $user->second_name,
            'first_last_name'  => $user->first_last_name,
            'second_last_name' => $user->second_last_name,
            'phone'            => $user->phone,
            'phone_ext'        => $user->phone_ext,
            'active'           => $user->active,
            'imagen'           => $user->imagen,
            'lang'             => $user->lang ?? 'es',
            'has_2fa'          => $this->twoFactor->isEnabled($user),
            'roles'            => $user->getRoleNames()->toArray(),
            'permissions'      => $user->getAllPermissions()->pluck('name')->toArray(),
        ];
    }
}

