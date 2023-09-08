<?php

namespace Otnansirk\SnapBI\Support;

use Otnansirk\SnapBI\Interfaces\HttpResponseInterface;

final class HttpResponse implements HttpResponseInterface
{

    private $body;
    private $status;
    private $headers;

    function __construct(string $response, int $statusCode)
    {

        list($headers, $body) = explode("\r\n\r\n", $response, 2);

        $this->body    = $body;
        $this->status  = $statusCode;
        $this->headers = $headers;
    }

    /**
     * Get body as is
     *
     * @return string
     */
    function body(): string
    {
        return $this->body;
    }

    /**
     * Get status code
     *
     * @return integer
     */
    function status(): int
    {
        return $this->status;
    }

    /**
     * Get body as object
     *
     * @return object
     */
    function object(): object
    {
        return json_decode($this->body);
    }

    /**
     * Get body as array
     *
     * @return array
     */
    function array(): array
    {
        return json_decode($this->body, true);
    }

    /**
     * Get headers response
     *
     * @return array
     */
    function headers(): array
    {
        $headers = explode("\r\n", $this->headers);

        $headerArr = array();
        foreach ($headers as $headerLine) {
            list($key, $value) = explode(': ', $headerLine, 2);
            $headerArr[$key]   = $value;
        }
        return $headerArr;
    }

    /**
     * Check is status code not in range 200 - 299
     *
     * @return boolean
     */
    function failed(): bool
    {
        return !(($this->status >= 200) && ($this->status < 300));
    }
}