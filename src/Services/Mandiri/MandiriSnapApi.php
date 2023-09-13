<?php

namespace Otnansirk\SnapBI\Services\Mandiri;

use Otnansirk\SnapBI\Core\SnapApiCore;
use Otnansirk\SnapBI\Exception\SnapBiException;
use Otnansirk\SnapBI\Interfaces\SnapApiInterface;
use Otnansirk\SnapBI\Services\Mandiri\Traits\HasAccessToken;
use Otnansirk\SnapBI\Services\Mandiri\Traits\HasTransaction;
use Otnansirk\SnapBI\Traits\HasSelfCall;

class MandiriSnapApi extends SnapApiCore implements SnapApiInterface
{
    use HasSelfCall;
    use HasAccessToken;
    use HasTransaction;

    function __construct()
    {
        if (!count(MandiriConfig::all())) {
            throw new SnapBiException("Please register configuration first. See https://php-snap-bi.gitbook.io/docs/getting-started/configuration", 1);
        }
    }
}