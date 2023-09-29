<?php

namespace Otnansirk\SnapBI\Services\DANA\Traits;

use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;
use Otnansirk\SnapBI\Services\DANA\DanaConfig;
use Otnansirk\SnapBI\Support\Signature;
use Otnansirk\SnapBI\Support\Http;
use Ramsey\Uuid\Uuid;


trait HasTransaction
{

    /**
     * Get list of bank statment
     *
     * @param string $startDate | Format ISO-8601 "2023-08-22T00:00:00+07:00"
     * @param string $endDate | Format ISO-8601 "2023-08-22T00:00:00+07:00"
     * @return HttpResponseInterface
     */
    public static function directDebitPayment(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/v1.0/debit/payment.htm";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo" => Uuid::uuid4(),
            "merchantId"         => DanaConfig::get('account_id'),
        ], self::$body);

        $headers = array_merge([
            'X-TIMESTAMP'   => $timestamp,
            'X-SIGNATURE'   => Signature::danaAsymetricTransaction(DanaConfig::class, 'POST', $path, $body, $timestamp),
            'CHANNEL-ID'    => DanaConfig::get('channel_id'),
            'X-PARTNER-ID'  => DanaConfig::get('partner_id'),
            'X-EXTERNAL-ID' => int_rand(16),
        ], self::$headers);

        $url = DanaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }
}