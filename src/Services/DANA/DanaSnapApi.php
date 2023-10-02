<?php

namespace Otnansirk\SnapBI\Services\DANA;

use Otnansirk\SnapBI\Core\SnapApiCore;
use Otnansirk\SnapBI\Exception\SnapBiException;
use Otnansirk\SnapBI\Interfaces\SnapApiInterface;
use Otnansirk\SnapBI\Services\DANA\Traits\HasAccessToken;
use Otnansirk\SnapBI\Services\DANA\Traits\HasTransaction;
use Otnansirk\SnapBI\Traits\HasSelfCall;

class DanaSnapApi extends SnapApiCore implements SnapApiInterface
{
    use HasSelfCall;
    use HasAccessToken;
    use HasTransaction;

    function __construct()
    {
        if (!count(DanaConfig::all())) {
            throw new SnapBiException("Please register configuration first. See https://php-snap-bi.gitbook.io/docs/getting-started/configuration", 1);
        }
    }
}