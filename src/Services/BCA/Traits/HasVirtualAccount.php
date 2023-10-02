<?php

namespace Otnansirk\SnapBI\Services\BCA\Traits;

use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;
use Otnansirk\SnapBI\Services\BCA\BcaConfig;
use Otnansirk\SnapBI\Support\Signature;
use Otnansirk\SnapBI\Support\Http;


trait HasVirtualAccount
{

    /**
     * This service is used to VA BillPresentment.
     *
     * @return HttpResponseInterface
     */
    public static function vaInquiry(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-va/inquiry";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge(BcaConfig::defaultBody(), self::$body);

        $headers = array_merge(
            BcaConfig::defaultHeaders(),
            [
                'X-TIMESTAMP' => $timestamp,
                'X-SIGNATURE' => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            ],
            self::$headers
        );

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }

    /**
     * This service is used to VA Payment Status.
     *
     * @return HttpResponseInterface
     */
    public static function vaInquiryStatus(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-va/status";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge(BcaConfig::defaultBody(), self::$body);

        $headers = array_merge(
            BcaConfig::defaultHeaders(),
            [
                'X-TIMESTAMP' => $timestamp,
                'X-SIGNATURE' => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            ],
            self::$headers
        );

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }

    /**
     * This service is used to VA Payment Flag.
     *
     * @return HttpResponseInterface
     */
    public static function vaPayment(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-va/payment";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge(BcaConfig::defaultBody(), self::$body);

        $headers = array_merge(
            BcaConfig::defaultHeaders(),
            [
                'X-TIMESTAMP' => $timestamp,
                'X-SIGNATURE' => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            ],
            self::$headers
        );

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }

    /**
     * This service is used to VA transfer BillPresentment.
     *
     * @return HttpResponseInterface
     */
    public static function vaInquiryIntrabank(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-va/inquiry-intrabank";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge(BcaConfig::defaultBody(), self::$body);

        $headers = array_merge(
            BcaConfig::defaultHeaders(),
            [
                'X-TIMESTAMP' => $timestamp,
                'X-SIGNATURE' => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            ],
            self::$headers
        );

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }

    /**
     * SNAP Virtual Account Payment to VA from Intrabank
     * This service is used to VA transfer.
     *
     * @return HttpResponseInterface
     */
    public static function vaPayIntrabank(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-va/payment-intrabank";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge(BcaConfig::defaultBody(), self::$body);

        $headers = array_merge(
            BcaConfig::defaultHeaders(),
            [
                'X-TIMESTAMP' => $timestamp,
                'X-SIGNATURE' => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            ],
            self::$headers
        );

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }

    /**
     * This service is used to Notification VA transfer.
     *
     * @return HttpResponseInterface
     */
    public static function vaNotifyPayIntrabank(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-va/notify-payment-intrabank";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge(BcaConfig::defaultBody(), self::$body);

        $headers = array_merge(
            BcaConfig::defaultHeaders(),
            [
                'X-TIMESTAMP' => $timestamp,
                'X-SIGNATURE' => Signature::symmetric(BcaConfig::class, 'POST', $path, $body, $timestamp, $accessToken),
            ],
            self::$headers
        );

        $url = BcaConfig::get('base_url') . $path;
        return Http::withToken($accessToken)
            ->withHeaders($headers)
            ->post($url, $body);
    }

}