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
     * POST /api/2fa/enable
     *
     * Genera un secreto TOTP y devuelve la URL del QR y la clave manual.
     * El usuario aún no tiene el 2FA confirmado hasta verificar el código.
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
     * POST /api/2fa/verify
     *
     * Verifica el código TOTP y confirma el 2FA si aún no está confirmado,
     * o valida la sesión si ya estaba activo.
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
