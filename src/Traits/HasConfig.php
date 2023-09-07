<?php

namespace Otnansirk\SnapBI\Traits;


trait HasConfig
{
    private static $configs = [];

    /**
     * Required config fields
     *
     * @var array
     */
    private static $requiredConfigFields = [
        "bank_card_token",
        "ssh_private_key",
        "ssh_public_key",
        "client_secret",
        "account_id",
        "partner_id",
        "channel_id",
        "client_id",
        "base_url"
    ];

    /**
     * Register configs
     *
     * @param array $configs
     * @return void
     */
    public function register(array $configs = []): void
    {
        foreach (self::$requiredConfigFields as $field) {
            if (!isset($configs[$field]) || empty($configs[$field])) {
                throw new \InvalidArgumentException("$field is Required");
            }
            self::$configs[$field] = $configs[$field];
        }
    }

    /**
     * Get all configs
     *
     * @return array
     */
    static function all(): array
    {
        return self::$configs;
    }

    /**
     * Get single config
     *
     * @param string $name
     * @return string|null
     */
    static function get(string $name): string|null
    {
        return isset(self::$configs[$name]) ? self::$configs[$name] : null;
    }

}