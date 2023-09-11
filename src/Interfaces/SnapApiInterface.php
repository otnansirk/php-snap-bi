<?php
namespace Otnansirk\SnapBI\Interfaces;

interface SnapApiInterface
{
    // CORE
    static function call(): self;

    // ACCESS TOKEN

    /**
     * Set token if needed
     * If not privide $token will auto request accessTokenB2b
     *
     * @param string $token
     * @return self
     */
    public static function withTokenB2b(string $token = null): self;

    /**
     * Get access token
     *
     * @return HttpResponseInterface
     */
    public static function accessTokenB2b(): HttpResponseInterface;

    // TRANSACTION

    /**
     * Get list of bank statment
     *
     * @param string $startDate
     * @param string $endDate
     * @return HttpResponseInterface
     */
    public static function bankStatement(string $startDate, string $endDate): HttpResponseInterface;
}