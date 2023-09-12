<?php
namespace Otnansirk\SnapBI\Services;

use Otnansirk\SnapBI\Exception\SnapBiException;
use Otnansirk\SnapBI\Interfaces\ConfigInterface;
use Otnansirk\SnapBI\Services\BCA\BcaConfig;
use Otnansirk\SnapBI\Services\Mandiri\MandiriConfig;

final class Config
{

    /**
     * Register configs
     *
     * @return array
     */
    static function registeredConfig(): array
    {
        return [
            'bca'     => BcaConfig::class,
            'mandiri' => MandiriConfig::class,
        ];
    }

    /**
     * Getting config by name
     * Currently support for
     * bca, mandiri, bri
     *
     * @param string $name
     * @return ConfigInterface
     */
    static function for (string $name): ConfigInterface
    {
        if (isset(self::registeredConfig()[$name])) {
            return self::registeredConfig()[$name]::call();
        }

        throw new SnapBiException("SNAP config for $name is not registered");
    }

    /**
     * If call an inaccessible static method of a class
     * will automatically invoke the __callStatic()
     * and return Config by method name
     *
     * @param string $method
     * @param array|null $args
     * @return ConfigInterface
     */
    static function __callStatic(string $method, array $args = null): ConfigInterface
    {
        if ($args) {
            self::for($method)->register($args[0]);
        }
        return self::for($method);
    }

}