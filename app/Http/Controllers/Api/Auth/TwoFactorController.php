<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorVerifyRequest;
use App\Models\User;
use App\Services\Contracts\TwoFactorServiceInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    use ApiResponse;

    public function __construct(private readonly TwoFactorServiceInterface $twoFactor) {}

    /**
     * Habilitar autenticación de dos factores
     *
     * Genera un secreto TOTP y devuelve la URL del código QR y la clave manual
     * para configurar una app autenticadora (Google Authenticator, Authy, etc.).
     * El 2FA no queda activo hasta que se verifique un código con `POST /api/2fa/verify`.
     *
     * @group Autenticación de Dos Factores (2FA)
     *
     * @response 200 scenario="Secreto generado" {
     *   "success": true,
     *   "message": "Secreto 2FA generado. Escanea el QR con tu app autenticadora.",
     *   "data": {
     *     "qr_code_url": "data:image/png;base64,iVBORw0KGgo...",
     *     "manual_entry_key": "JBSWY3DPEHPK3PXP",
     *     "message": "Escanea el código QR con Google Authenticator o ingresa la clave manualmente."
     *   }
     * }
     * @response 409 scenario="2FA ya está activo" {
     *   "success": false,
     *   "message": "La autenticación de dos factores ya está habilitada",
     *   "errors": ""
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function enable(Request $request)
    {
        try {
            /** @var User $user */
            $user = $request->user();

            if ($this->twoFactor->isEnabled($user)) {
                return $this->errorResponse(
                    __('messages.two_factor.already_enabled'),
                    '',
                    409
                );
            }

            $data = $this->twoFactor->generateSecret($user);

            return $this->successResponse([
                'qr_code_url'      => $data['qr_code_url'],
                'manual_entry_key' => $data['manual_entry_key'],
                'message'          => __('messages.two_factor.scan_instruction'),
            ], __('messages.two_factor.generated'), 200);

        } catch (\Throwable) {
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }

    /**
     * Verificar código de dos factores
     *
     * Verifica el código TOTP de 6 dígitos generado por la app autenticadora.
     * Si el 2FA aún no estaba confirmado, lo activa en este paso.
     * Devuelve un nuevo Bearer Token con acceso completo.
     *
     * @group Autenticación de Dos Factores (2FA)
     *
     * @bodyParam code string required Código TOTP de 6 dígitos de la app autenticadora. Example: 123456
     *
     * @response 200 scenario="Código válido" {
     *   "success": true,
     *   "message": "Autenticación de dos factores verificada",
     *   "data": {
     *     "token": "4|dEfGhIjK...",
     *     "token_type": "Bearer",
     *     "verified": true
     *   }
     * }
     * @response 422 scenario="Código inválido" {
     *   "success": false,
     *   "message": "El código ingresado es incorrecto",
     *   "errors": ""
     * }
     * @response 422 scenario="2FA no configurado" {
     *   "success": false,
     *   "message": "El 2FA no ha sido configurado. Usa POST /api/2fa/enable primero.",
     *   "errors": ""
     * }
     * @response 422 scenario="Validación fallida" {
     *   "success": false,
     *   "message": "Los datos proporcionados no son válidos",
     *   "errors": { "code": ["El campo code debe tener 6 dígitos."] }
     * }
     * @response 401 scenario="No autenticado" {
     *   "message": "Unauthenticated."
     * }
     */
    public function verify(TwoFactorVerifyRequest $request)
    {
        try {
            /** @var User $user */
            $user = $request->user();

            if (empty($user->two_factor_secret)) {
                return $this->errorResponse(
                    __('messages.two_factor.not_configured'),
                    '',
                    422
                );
            }

            if (!$this->twoFactor->verifyCode($user, $request->input('code'))) {
                return $this->errorResponse(__('messages.two_factor.invalid_code'), '', 422);
            }

            // Confirmar el 2FA si aún no estaba confirmado
            if (!$this->twoFactor->isEnabled($user)) {
                $this->twoFactor->confirm($user);
            }

            // Renovar el token para que tenga las capacidades completas
            $user->tokens()->delete();
            $token = $user->createToken('angular-panel')->plainTextToken;

            return $this->successResponse([
                'token'      => $token,
                'token_type' => 'Bearer',
                'verified'   => true,
            ], __('messages.two_factor.verified'), 200);

        } catch (\Throwable) {
            return $this->errorResponse(__('messages.general.error_retry'), '', 500);
        }
    }
}
