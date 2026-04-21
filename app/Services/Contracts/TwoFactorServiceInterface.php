<?php

namespace App\Services\Contracts;

use App\Models\User;

interface TwoFactorServiceInterface
{
    /**
     * Genera un nuevo secreto TOTP y lo asocia al usuario (sin confirmar).
     *
     * @param  User  $user
     * @return array{ secret: string, qr_code_url: string, manual_entry_key: string }
     */
    public function generateSecret(User $user): array;

    /**
     * Verifica un código TOTP contra el secreto del usuario.
     *
     * @param  User    $user
     * @param  string  $code  Código de 6 dígitos
     * @return bool
     */
    public function verifyCode(User $user, string $code): bool;

    /**
     * Marca el 2FA del usuario como confirmado.
     *
     * @param  User  $user
     * @return void
     */
    public function confirm(User $user): void;

    /**
     * Indica si el usuario tiene 2FA activo y confirmado.
     *
     * @param  User  $user
     * @return bool
     */
    public function isEnabled(User $user): bool;
}
