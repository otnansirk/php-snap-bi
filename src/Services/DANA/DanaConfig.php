<?php

namespace Otnansirk\SnapBI\Services\DANA;

use Otnansirk\SnapBI\Interfaces\ConfigInterface;
use Otnansirk\SnapBI\Traits\HasConfig;
use Otnansirk\SnapBI\Traits\HasSelfCall;


final class DanaConfig implements ConfigInterface
{
    use HasConfig, HasSelfCall;
}