<?php

namespace Otnansirk\SnapBI\Interfaces;


interface ConfigInterface
{

    // CORE
    static function call(): self;

    /**
     * Register config
     *
     * @param array $configs
     * @return void
     */
    public function register(array $configs = []): void;

    /**
     * Get all config
     *
     * @return array
     */
    public static function all(): array;

    /**
     * Get single config
     *
     * @param string $name
     * @return string|null
     */
    public static function get(string $name): string|null;
}