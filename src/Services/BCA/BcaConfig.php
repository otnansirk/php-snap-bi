<?php

namespace Otnansirk\SnapBI\Services\BCA;

use Otnansirk\SnapBI\Interfaces\ConfigInterface;
use Otnansirk\SnapBI\Traits\HasConfig;
use Otnansirk\SnapBI\Traits\HasSelfCall;


final class BcaConfig implements ConfigInterface
{
    use HasConfig, HasSelfCall;
}