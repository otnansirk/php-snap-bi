<?php
namespace Otnansirk\SnapBI\Core;

class SnapApiCore
{
    public static $headers;
    public static $body;

    /**
     * Set headers
     *
     * @param array $headers
     * @return static
     */
    function withHeaders(array $headers): static
    {
        static::$headers = $headers;
        return new static;
    }

    /**
     * Set body
     *
     * @param array $body
     * @return static
     */
    function withBody(array $body): static
    {
        static::$body = $body;
        return new static;
    }

}