<?php

namespace Otnansirk\SnapBI\Services\BRI;

use Otnansirk\SnapBI\Interfaces\ConfigInterface;
use Otnansirk\SnapBI\Traits\HasConfig;
use Otnansirk\SnapBI\Traits\HasSelfCall;


final class BriConfig implements ConfigInterface
{
    use HasConfig, HasSelfCall;
}