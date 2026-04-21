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

    // POST /api/login
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

    // POST /api/register
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

    // POST /api/forgot-password
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

    // POST /api/reset-password
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

    // POST /api/logout
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->successResponse([], __('messages.auth.session_closed'), 200);
        } catch (\Throwable) {
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    // GET /api/me
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

