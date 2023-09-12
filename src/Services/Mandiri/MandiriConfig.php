<?php

namespace Otnansirk\SnapBI\Services\Mandiri;

use Otnansirk\SnapBI\Interfaces\ConfigInterface;
use Otnansirk\SnapBI\Traits\HasConfig;
use Otnansirk\SnapBI\Traits\HasSelfCall;


final class MandiriConfig implements ConfigInterface
{
    use HasConfig, HasSelfCall;
}