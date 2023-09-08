<?php

namespace Otnansirk\SnapBI\Support;

use Otnansirk\SnapBI\Exception\HttpException;
use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;

final class Http
{
    public static $optHeaders = array();

    /**
     * Set token for authorization
     *
     * @param string $token
     * @param string $type
     * @return static
     */
    public static function withToken(string $token, string $type = 'Bearer'): static
    {
        self::$optHeaders['Authorization'] = trim($type . ' ' . $token);
        return new static;
    }

    /**
     * Undocumented function
     *
     * @param array $headers
     * @return self
     */
    public static function withHeaders(array $headers): static
    {
        self::$optHeaders = [...self::$optHeaders, ...$headers];
        return new static;
    }

    /**
     * Request with method GET
     *
     * @param string $url
     * @param array $headers
     * @return object|null
     */
    public static function get(string $url): HttpResponseInterface|null
    {
        try {
            return self::requestor($url, 'GET', self::$optHeaders);
        } catch (\Throwable $th) {
            throw new HttpException("Error Processing Request");
        }
    }

    /**
     * Request with method POST
     *
     * @param string $url
     * @param array $body
     * @param array $headers
     * @return object|null
     */
    public static function post(string $url, array $body): HttpResponseInterface|null
    {
        try {
            return self::requestor($url, 'POST', self::$optHeaders, $body);
        } catch (\Throwable $th) {
            throw new HttpException("Error Processing Request");
        }
    }

    /**
     *
     * Requestor SNAP with CURL
     *
     * @param string $url
     * @param string $method
     * @param array $headers
     * @param array $body
     * @return object|null
     */
    public static function requestor(
        string $url,
        string $method = 'POST',
        array $headers = [],
        array $body = []
    ): HttpResponseInterface {
        $ch = curl_init();

        try {
            $curlHeaders = array_merge(
                array(
                    'Content-Type: application/json',
                    'Accept: application/json'
                ),
                self::headerFormated($headers),
            );

            $curlOptions = array(
                CURLOPT_URL            => $url,
                CURLOPT_HTTPHEADER     => $curlHeaders,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => true,
                CURLOPT_CUSTOMREQUEST  => strtoupper($method),
                CURLOPT_POSTFIELDS     => json_encode($body)
            );
            curl_setopt_array($ch, $curlOptions);

            // Get http status code info
            $httpCode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $statusCode = http_response_code($httpCode);

            $response = curl_exec($ch);
            curl_close($ch);

            return new HttpResponse($response, $statusCode);

        } catch (\Throwable $th) {
            throw new HttpException("Error when request API");
        }
    }

    /**
     * Format array header to cUrl header
     *
     * @param array $headers
     * @return array
     */
    public static function headerFormated(array $headers): array
    {

        $result = array();
        foreach ($headers as $key => $value) {
            $result[] = $key . ':' . $value;
        }
        return $result;
    }
}