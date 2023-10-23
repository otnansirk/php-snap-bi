<?php

namespace Otnansirk\SnapBI\Services\BRI\Traits;

use Carbon\Carbon;
use Otnansirk\SnapBI\Exception\AuthenticateException;
use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;
use Otnansirk\SnapBI\Services\BRI\BriConfig;
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
        $carbon = Carbon::now('Asia/Jakarta');
        $timestamp = $carbon->format('Y-m-d\TH:i:s.000P'); // outputs: 2021-11-02T13:14:15.000+07:00
        $path    = BriConfig::get('base_url') . "/snap/v1.0/access-token/b2b";
        $headers = [
            'X-TIMESTAMP'  => $timestamp,
            'X-CLIENT-KEY' => BriConfig::get('client_id'),
            'X-SIGNATURE'  => Signature::asymmetricBri(BriConfig::class,$timestamp),
        ];

        $body = ['grantType' => 'client_credentials'];
        return Http::withHeaders($headers)->post($path, $body);
    }
}