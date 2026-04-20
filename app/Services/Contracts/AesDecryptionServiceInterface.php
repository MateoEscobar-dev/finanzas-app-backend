<?php

namespace App\Services\Contracts;

interface AesDecryptionServiceInterface
{
    /**
     * Descifra un payload AES enviado desde Angular (CryptoJS).
     *
     * El payload es un JSON con la estructura:
     * { "salt": "<hex>", "iv": "<hex>", "ciphertext": "<base64>" }
     *
     * @param  string  $encryptedPayload  JSON serializado o string plano
     * @return string  Texto descifrado
     *
     * @throws \RuntimeException  Si el payload es inválido o el descifrado falla
     */
    public function decrypt(string $encryptedPayload): string;

    /**
     * Indica si el payload tiene el formato cifrado de Angular.
     *
     * @param  string  $value
     * @return bool
     */
    public function isEncryptedPayload(string $value): bool;
}
