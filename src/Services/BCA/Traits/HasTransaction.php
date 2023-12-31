<?php

namespace Otnansirk\SnapBI\Services\BCA\Traits;

use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;
use Otnansirk\SnapBI\Services\BCA\BcaConfig;
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
        $path = "/openapi/v1.0/bank-statement";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo" => Uuid::uuid4(),
            "accountNo"          => BcaConfig::get('account_id'),
            "fromDateTime"       => $startDate,
            "toDateTime"         => $endDate,
            "bankCardToken"      => BcaConfig::get('bank_card_token')
        ], self::$body);

        $headers = array_merge([
            'X-TIMESTAMP'   => $timestamp,
            'X-SIGNATURE'   => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            'CHANNEL-ID'    => BcaConfig::get('channel_id'),
            'X-PARTNER-ID'  => BcaConfig::get('partner_id'),
            'X-EXTERNAL-ID' => int_rand(16),
        ], self::$headers);

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }

    /**
     * This service is used to pre-processing OneKlik Registration by Generating OneKlik Registration Web Token.
     *
     * @return HttpResponseInterface
     */
    public static function directDebitPayment(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/oneklik/v1.0/debit/payment-host-to-host";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo" => Uuid::uuid4(),
            "accountNo"          => BcaConfig::get('account_id'),
            "merchantId"         => BcaConfig::get('partner_id'),
            "bankCardToken"      => BcaConfig::get('bank_card_token')
        ], self::$body);

        $headers = array_merge([
            'X-TIMESTAMP'   => $timestamp,
            'X-SIGNATURE'   => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            'CHANNEL-ID'    => BcaConfig::get('channel_id'),
            'X-PARTNER-ID'  => BcaConfig::get('partner_id'),
            'X-EXTERNAL-ID' => int_rand(16),
        ], self::$headers);

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }

    /**
     * This service is used to inquiry OneKlik transaction status.
     *
     * @return HttpResponseInterface
     */
    public static function directDebitPaymentStatus(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/oneklik/v1.0/debit/status";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo" => Uuid::uuid4(),
            "serviceCode"        => '54',
        ], self::$body);

        $headers = array_merge([
            'X-TIMESTAMP'   => $timestamp,
            'X-SIGNATURE'   => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            'CHANNEL-ID'    => BcaConfig::get('channel_id'),
            'X-PARTNER-ID'  => BcaConfig::get('partner_id'),
            'X-EXTERNAL-ID' => int_rand(16),
        ], self::$headers);

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }
}