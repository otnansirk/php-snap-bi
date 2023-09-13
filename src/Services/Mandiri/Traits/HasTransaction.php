<?php

namespace Otnansirk\SnapBI\Services\Mandiri\Traits;

use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;
use Otnansirk\SnapBI\Services\Mandiri\MandiriConfig;
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
    public static function bankStatement(string $startDate, string $endDate): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/transactions/v2.0/bank-statement";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo" => Uuid::uuid4(),
            "accountNo"          => MandiriConfig::get('account_id'),
            "fromDateTime"       => $startDate,
            "toDateTime"         => $endDate,
            "bankCardToken"      => MandiriConfig::get('bank_card_token')
        ], self::$body);

        $headers = array_merge([
            'X-TIMESTAMP'   => $timestamp,
            'X-SIGNATURE'   => Signature::symmetric(MandiriConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            'CHANNEL-ID'    => MandiriConfig::get('channel_id'),
            'X-PARTNER-ID'  => MandiriConfig::get('partner_id'),
            'X-EXTERNAL-ID' => int_rand(16),
        ], self::$headers);

        $url = MandiriConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }
}