<?php
namespace Otnansirk\SnapBI\Support;

use Otnansirk\SnapBI\Exception\SignatureException;

final class Signature
{

    /**
     * Generate asymmetric signature
     *
     * @param string $config
     * @return string
     */
    final public static function asymmetric(string $config): string
    {
        $privateKey   = $config::get('ssh_private_key');
        $stringToSign = $config::get('client_id') . '|' . currentTimestamp()->toIso8601String();

        $signature = "";
        if (!openssl_sign($stringToSign, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            throw new SignatureException("Failed to generate signature");
        }

        // X-SIGNATURE
        return base64_encode($signature);
    }


    /**
     * Generate signature symmetric
     * @return string
     */
    final public static function symmetric(
        string $config,
        string $method,
        string $path,
        array $body,
        string $timestamp,
        string $accessToken
    ): string {
        // Body minify
        $hashBody = json_encode($body);

        // Calculate Hash with sha256
        $hashBody = hash('sha256', $hashBody);

        // Convert to lowercase
        $signedBody = strtolower($hashBody);

        $stringToSign = implode(':', [
            $method,
            $path,
            $accessToken,
            $signedBody,
            $timestamp
        ]);

        $signature = hash_hmac('sha512', $stringToSign, $config::get('client_secret'), true);

        // X-SIGNATURE
        return base64_encode($signature);
    }
}