<?php
namespace Otnansirk\SnapBI\Services;

use Otnansirk\SnapBI\Exception\SnapBiException;
use Otnansirk\SnapBI\Interfaces\SnapApiInterface;
use Otnansirk\SnapBI\Services\BCA\BcaSnapApi;
use Otnansirk\SnapBI\Services\DANA\DanaSnapApi;
use Otnansirk\SnapBI\Services\Mandiri\MandiriSnapApi;

final class SnapBi
{

    /**
     * Register Snap Api
     *
     * @return array
     */
    static function registeredSnapApi(): array
    {
        return [
            'bca'     => BcaSnapApi::class,
            'mandiri' => MandiriSnapApi::class,
            'dana'    => DanaSnapApi::class,
            // Register new SnapApi
        ];
    }

    /**
     * Getting config by name
     * Currently support for
     * bca, mandiri, bri
     *
     * @param string $name
     * @return SnapApiInterface
     */
    static function for (string $name): SnapApiInterface
    {
        if (isset(self::registeredSnapApi()[$name])) {
            return self::registeredSnapApi()[$name]::call();
        }

        throw new SnapBiException("SNAP BI for $name is not registered");
    }
    /**
     * If call an inaccessible static method of a class
     * will automatically invoke the __callStatic()
     * and return SnapApi by method name
     *
     * @param string $method
     * @param array|null $args
     * @return SnapApiInterface
     */
    static function __callStatic(string $method, array $args = null): SnapApiInterface
    {
        return self::for($method);
    }

}