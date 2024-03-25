<?php

namespace Otnansirk\SnapBI\Services\DANA\Traits;

use Otnansirk\SnapBI\Exception\AuthenticateException;
use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;
use Otnansirk\SnapBI\Services\DANA\DanaConfig;
use Otnansirk\SnapBI\Support\HttpResponse;
use Otnansirk\SnapBI\Support\Signature;
use Otnansirk\SnapBI\Support\Http;
use Ramsey\Uuid\Uuid;


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
        $path    = DanaConfig::get('base_url') . "/v1.0/access-token/b2b.htm";
        $headers = [
            'X-TIMESTAMP'  => currentTimestamp()->toIso8601String(),
            'X-CLIENT-KEY' => DanaConfig::get('client_id'),
            'X-SIGNATURE'  => Signature::asymmetric(DanaConfig::class),
        ];

        $body = ['grantType' => 'client_credentials'];
        return Http::withHeaders($headers)->post($path, $body);
    }

    /**
     * Get oAuth url
     *
     * @param array $params
     * @param array $data
     * @param bool $sign
     *
     * @inheritDoc https://dashboard.dana.id/api-docs/read/125
     */
    public static function oAuthUrl(array $params = [], array $data = [], bool $sign = false)
    {
        $seamlessData = count($data)
            ? ['seamlessData' => json_encode($data)]
            : [];

        $seamlessSign = $sign
            ? ['seamlessSign' => Signature::signSHA256withRSA(DanaConfig::class, $data)]
            : [];

        $queryParams = [
            'timestamp'   => currentTimestamp()->toIso8601String(),
            'partnerId'   => DanaConfig::get('partner_id'),
            'externalId'  => Uuid::uuid4()->toString(),
            'channelId'   => DanaConfig::get('channel_id'),
            'state'       => int_rand(32),
            'scopes'      => 'QUERY_BALANCE,PUBLIC_ID',
            'redirectUrl' => DanaConfig::get('redirect_url'),
            ...$params,
            ...$seamlessData,
            ...$seamlessSign
        ];
        return DanaConfig::get('web_url') . "/v1.0/get-auth-code?" . http_build_query($queryParams);
    }
}