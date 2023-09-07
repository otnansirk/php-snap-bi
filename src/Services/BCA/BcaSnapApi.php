<?php

namespace Otnansirk\SnapBI\Services\BCA;

use Otnansirk\SnapBI\Exception\SnapBiException;
use Otnansirk\SnapBI\Interfaces\SnapApiInterface;
use Otnansirk\SnapBI\Services\BCA\Traits\HasAccessToken;
use Otnansirk\SnapBI\Services\BCA\Traits\HasTransaction;
use Otnansirk\SnapBI\Traits\HasSelfCall;

class BcaSnapApi implements SnapApiInterface
{
    use HasSelfCall;
    use HasAccessToken;
    use HasTransaction;

    function __construct()
    {
        if (!count(BcaConfig::all())) {
            throw new SnapBiException("Please register configuration first. See https://php-snap-bi.gitbook.io/docs/getting-started/configuration", 1);
        }
    }
}