<?php

namespace Otnansirk\SnapBI\Services\BCA;

use Otnansirk\SnapBI\Interfaces\ConfigInterface;
use Otnansirk\SnapBI\Traits\HasConfig;
use Otnansirk\SnapBI\Traits\HasSelfCall;
use Ramsey\Uuid\Uuid;


final class BcaConfig implements ConfigInterface
{
    use HasConfig, HasSelfCall;

    /**
     * Default headers
     *
     * @return array
     */
    public static function defaultHeaders(): array
    {

        return [
            'CHANNEL-ID'    => BcaConfig::get('channel_id'),
            'X-PARTNER-ID'  => BcaConfig::get('partner_id'),
            'X-EXTERNAL-ID' => int_rand(16),
        ];
    }

    /**
     * Default body
     *
     * @return array
     */
    public static function defaultBody(): array
    {
        return [
            "partnerReferenceNo" => Uuid::uuid4(),
            "accountNo"          => BcaConfig::get('account_id'),
            "bankCardToken"      => BcaConfig::get('bank_card_token')
        ];
    }
}