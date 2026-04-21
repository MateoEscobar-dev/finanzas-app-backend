<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Contracts\TwoFactorServiceInterface;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorService implements TwoFactorServiceInterface
{
    public function __construct(private readonly Google2FA $google2fa) {}

    public function generateSecret(User $user): array
    {
        $secret = $this->google2fa->generateSecretKey();

        $user->two_factor_secret       = $secret;
        $user->two_factor_confirmed_at = null;
        $user->save();

        $appName  = config('app.name', 'FinanzasApp');
        $qrUrl    = $this->google2fa->getQRCodeUrl($appName, $user->email, $secret);

        return [
            'secret'           => $secret,
            'qr_code_url'      => $qrUrl,   // URI otpauth:// para renderizar en frontend
            'manual_entry_key' => $secret,
        ];
    }

    public function verifyCode(User $user, string $code): bool
    {
        if (empty($user->two_factor_secret)) {
            return false;
        }

        return $this->google2fa->verifyKey($user->two_factor_secret, $code);
    }

    public function confirm(User $user): void
    {
        $user->two_factor_confirmed_at = now();
        $user->save();
    }

    public function isEnabled(User $user): bool
    {
        return !empty($user->two_factor_secret)
            && $user->two_factor_confirmed_at !== null;
    }
}
