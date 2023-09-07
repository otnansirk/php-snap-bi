<?php

namespace Otnansirk\SnapBI\Services\BCA\Traits;

use Otnansirk\SnapBI\Services\BCA\BcaConfig;
use Otnansirk\SnapBI\Support\Signature;
use Otnansirk\SnapBI\Support\Http;


trait HasTransaction
{
    /**
     * Get list of bank statment
     *
     * @param string $startDate
     * @param string $endDate
     * @return object|null
     */
    public static function bankStatement(string $startDate, string $endDate): object|null
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/bank-statement";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body    = [
            "partnerReferenceNo" => int_rand(8),
            "accountNo"          => BcaConfig::get('account_id'),
            "fromDateTime"       => $startDate . "T00:00:00+07:00",
            "toDateTime"         => $endDate . "T00:00:00+07:00",
            "bankCardToken"      => BcaConfig::get('bank_card_token')
        ];
        $headers = [
            'X-TIMESTAMP'   => $timestamp,
            'X-SIGNATURE'   => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            'CHANNEL-ID'    => BcaConfig::get('channel_id'),
            'X-PARTNER-ID'  => BcaConfig::get('partner_id'),
            'X-EXTERNAL-ID' => int_rand(8),
        ];

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }
}