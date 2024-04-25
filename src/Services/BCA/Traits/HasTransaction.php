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

    /**
     * this is function transfer rtgs
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function transferRTGS(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-rtgs";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo"           => Uuid::uuid4(),
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
     * This service is used to transfer SKNBI.
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function transferSKNBI(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-skn";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo"           => Uuid::uuid4(),
            "sourceAccountNo"              => BcaConfig::get('source_account_no')
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
     * This service is used to transfer intrabank.
     * means that the transfer is made within the same bank network
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function transferIntraBank(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/transfer-intrabank";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo"   => Uuid::uuid4(),
            "sourceAccountNo"      => BcaConfig::get('source_account_no'),
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
     * This service is used to transfer interbank online.
     * meaning that the sender uses a different Bank network to transfer to the receiver
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function transferInterBankONL(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v2.0/transfer-interbank";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo"     => Uuid::uuid4(),
            "sourceAccountNo"        => BcaConfig::get("source_account_no"),
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
     * This service is used to internal account inquiry.
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function internalAccountInquiry(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/account-inquiry-internal";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo"   => Uuid::uuid4(),
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
     * This service is used to internal account inquiry.
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function accountInquiryExternal(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/account-inquiry-external";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo"   => Uuid::uuid4()
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
     * This service is used to inquiry status transaction.
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function inquiryStatusTransaction(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/balance-inquiry";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "originalPartnerReferenceNo" => Uuid::uuid4()
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
     * This service is used to balance inquiry.
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function balanceInquiry(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v1.0/balance-inquiry";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo" => Uuid::uuid4(),
            "accountNo"          => BcaConfig::get('account_id'),
            "bankCardToken"      => BcaConfig::get('bank_card_token'),
        ],
            self::$body);

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
     * This service is used to transfer Bi fast.
     * @return HttpResponseInterface
     * @throws \Otnansirk\SnapBI\Exception\AuthenticateException
     * @throws \Otnansirk\SnapBI\Exception\HttpException
     */
    public static function transferBIFAST(): HttpResponseInterface
    {
        // Required access token
        self::authenticated();
        $path = "/openapi/v2.0/transfer-interbank";

        $timestamp   = currentTimestamp()->toIso8601String();
        $accessToken = self::$token;

        $body = array_merge([
            "partnerReferenceNo"     => Uuid::uuid4(),
            "sourceAccountNo"        => BcaConfig::get('source_account_no'),
        ],
            self::$body);

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