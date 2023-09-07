<?php

namespace Otnansirk\SnapBI\Services\BCA;

use Otnansirk\SnapBI\Interfaces\SnapApiInterface;
use Otnansirk\SnapBI\Services\BCA\Traits\HasAccessToken;
use Otnansirk\SnapBI\Services\BCA\Traits\HasTransaction;
use Otnansirk\SnapBI\Traits\HasSelfCall;

class BcaSnapApi implements SnapApiInterface
{
    use HasSelfCall;
    use HasAccessToken;
    use HasTransaction;
}