<?php

namespace Otnansirk\SnapBI\Services\Mandiri\Traits;

use Otnansirk\SnapBI\Exception\AuthenticateException;
use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;
use Otnansirk\SnapBI\Services\Mandiri\MandiriConfig;
use Otnansirk\SnapBI\Support\HttpResponse;
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
    public static function withTokenB2b(string $token = null): self
    {
        if ($token) {
            self::$token = $token;
        } else {
            self::$token = self::accessTokenB2b()->object()->accessToken;
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
     * @return HttpResponse
     */
    public static function accessTokenB2b(): HttpResponseInterface
    {
        $path    = MandiriConfig::get('base_url') . "/openapi/auth/v2.0/access-token/b2b";
        $headers = [
            'X-TIMESTAMP'  => currentTimestamp()->toIso8601String(),
            'X-CLIENT-KEY' => MandiriConfig::get('client_id'),
            'X-SIGNATURE'  => Signature::asymmetric(MandiriConfig::class),
        ];

        $body = ['grantType' => 'client_credentials'];
        return Http::withHeaders($headers)->post($path, $body);
    }
}