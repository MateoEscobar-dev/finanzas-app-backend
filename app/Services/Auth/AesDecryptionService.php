<?php

namespace App\Services\Auth;

use App\Services\Contracts\AesDecryptionServiceInterface;
use RuntimeException;

class AesDecryptionService implements AesDecryptionServiceInterface
{
    private string $sharedKey;

    public function __construct()
    {
        $key = config('app.aes_shared_key');

        if (empty($key)) {
            throw new RuntimeException('AES_SHARED_KEY no está configurada en el entorno.');
        }

        $this->sharedKey = $key;
    }

    /**
     * Descifra el payload AES generado por CryptoJS en Angular.
     *
     * Angular usa:
     *   const key  = CryptoJS.PBKDF2(sharedKey, salt, { keySize: 256/32, iterations: 1000 });
     *   const enc  = CryptoJS.AES.encrypt(password, key, { iv });
     *
     * PHP equivale a:
     *   $key = hash_pbkdf2('sha1', sharedKey, hex2bin(salt), 1000, 32, true);
     *   openssl_decrypt(base64_decode(ciphertext), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, hex2bin(iv));
     */
    public function decrypt(string $encryptedPayload): string
    {
        $data = json_decode($encryptedPayload, true);

        if (
            !is_array($data)
            || empty($data['salt'])
            || empty($data['iv'])
            || empty($data['ciphertext'])
        ) {
            throw new RuntimeException('El payload cifrado tiene un formato inválido.');
        }

        $saltBin       = hex2bin($data['salt']);
        $ivBin         = hex2bin($data['iv']);
        $ciphertextBin = base64_decode($data['ciphertext']);

        if ($saltBin === false || $ivBin === false || $ciphertextBin === false) {
            throw new RuntimeException('Los campos del payload no son valores hexadecimales/base64 válidos.');
        }

        // Derivar clave con PBKDF2-SHA256 — CryptoJS 4.x usa SHA-256 por defecto (cambió de SHA-1 en v4.0.0)
        $derivedKey = hash_pbkdf2('sha256', $this->sharedKey, $saltBin, 1000, 32, true);

        $decrypted = openssl_decrypt(
            $ciphertextBin,
            'aes-256-cbc',
            $derivedKey,
            OPENSSL_RAW_DATA,
            $ivBin
        );

        if ($decrypted === false) {
            throw new RuntimeException('No se pudo descifrar el payload. Verifica la clave AES_SHARED_KEY.');
        }

        return $decrypted;
    }

    public function isEncryptedPayload(string $value): bool
    {
        $data = json_decode($value, true);

        return is_array($data)
            && isset($data['salt'], $data['iv'], $data['ciphertext']);
    }
}
