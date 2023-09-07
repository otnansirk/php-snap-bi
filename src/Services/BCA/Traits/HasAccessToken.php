<?php

namespace Otnansirk\SnapBI\Services\BCA\Traits;

use Otnansirk\SnapBI\Exception\AuthenticateException;
use Otnansirk\SnapBI\Services\BCA\BcaConfig;
use Otnansirk\SnapBI\Support\Signature;
use Otnansirk\SnapBI\Support\Http;


trait HasAccessToken
{

    protected static $token;

    /**
     * Set token if needed
     *
     * @param string $token
     * @return self
     */
    public static function withTokenb2b(string $token = null): self
    {
        if ($token) {
            self::$token = $token;
        } else {
            self::$token = self::accessTokenb2b()->accessToken;
        }

        return new self;
    }

    /**
     * Throw error if not authenticated
     *
     * @return void
     */
    public static function authenticated()
    {
        if (!self::$token) {
            throw new AuthenticateException("Unauthorized: Please provide an access token", 400);
        }
    }

    /**
     * Get access token
     *
     * @return string | null
     */
    public static function accessTokenb2b(): object|null
    {
        $path    = BcaConfig::get('base_url') . "/openapi/v1.0/access-token/b2b";
        $headers = [
            'X-TIMESTAMP'  => currentTimestamp()->toIso8601String(),
            'X-CLIENT-KEY' => BcaConfig::get('client_id'),
            'X-SIGNATURE'  => Signature::asymmetric(BcaConfig::class),
        ];

        $body = ['grantType' => 'client_credentials'];
        return Http::withHeaders($headers)->post($path, $body);
    }
}