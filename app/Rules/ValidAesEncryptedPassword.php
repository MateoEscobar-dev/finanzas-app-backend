<?php

namespace App\Rules;

use App\Services\Contracts\AesDecryptionServiceInterface;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Valida que el campo sea un payload AES descifrable con la clave compartida.
 * Opcionalmente valida la complejidad del password descifrado.
 */
class ValidAesEncryptedPassword implements ValidationRule
{
    /**
     * @param  bool  $enforceComplexity  Si true, valida mayúscula, número y carácter especial
     */
    public function __construct(private readonly bool $enforceComplexity = false) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var AesDecryptionServiceInterface $aes */
        $aes = app(AesDecryptionServiceInterface::class);

        if (!$aes->isEncryptedPayload((string) $value)) {
            $fail('El campo :attribute no tiene el formato cifrado requerido ({salt, iv, ciphertext}).');
            return;
        }

        try {
            $plain = $aes->decrypt((string) $value);
        } catch (\RuntimeException) {
            $fail('No se pudo descifrar el campo :attribute. Verifique la clave AES.');
            return;
        }

        if ($this->enforceComplexity) {
            if (strlen($plain) < 8) {
                $fail('El campo :attribute debe tener al menos 8 caracteres tras descifrarse.');
                return;
            }

            if (!preg_match('/[A-Z]/', $plain)) {
                $fail('El campo :attribute debe contener al menos una letra mayúscula.');
                return;
            }

            if (!preg_match('/[0-9]/', $plain)) {
                $fail('El campo :attribute debe contener al menos un número.');
                return;
            }

            if (!preg_match('/[\W_]/', $plain)) {
                $fail('El campo :attribute debe contener al menos un carácter especial.');
                return;
            }
        }
    }
}
