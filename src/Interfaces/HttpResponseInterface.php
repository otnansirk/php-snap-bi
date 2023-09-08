<?php
namespace Otnansirk\SnapBI\Interfaces;

interface HttpResponseInterface
{

    /**
     * Get body as is
     *
     * @return string
     */
    function body(): string;

    /**
     * Get status code
     *
     * @return integer
     */
    function status(): int;

    /**
     * Get body as object
     *
     * @return object
     */
    function object(): object;

    /**
     * Get body as array
     *
     * @return array
     */
    function array(): array;

    /**
     * Get headers response
     *
     * @return array
     */
    function headers(): array;

    /**
     * Check is status code not in range 200 - 299
     *
     * @return boolean
     */
    function failed(): bool;
}