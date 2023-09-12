<?php
use Otnansirk\SnapBI\Fixtures\Fixture;
use Otnansirk\SnapBI\Services\Config;
use Otnansirk\SnapBI\Services\SnapBi;
use PHPUnit\Framework\TestCase;

final class BcaSnapBiTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        Config::bca(Fixture::configFixture());
    }

    function testAccessTokenB2b()
    {
        $res = SnapBi::bca()->accessTokenB2b();
        $this->assertEquals(200, $res->status());
    }

    function testBankStatement()
    {
        $res = SnapBi::bca()
            ->withTokenB2b()
            ->bankStatement('2023-08-22T00:00:00+07:00', '2023-08-22T00:00:00+07:00');
        $this->assertEquals(200, $res->status());
    }

    public function tearDown(): void
    {
        // One second interval to avoid throttle
        sleep(1);
    }

}