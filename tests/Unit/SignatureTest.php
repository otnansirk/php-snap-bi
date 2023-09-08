<?php
use Otnansirk\SnapBI\Support\Signature;
use Otnansirk\SnapBI\Fixtures\Fixture;
use Otnansirk\SnapBI\Services\Config;
use PHPUnit\Framework\TestCase;

final class SignatureTest extends TestCase
{
    function testAsymmetric()
    {
        Config::bca(Fixture::configFixture());
        $res = Signature::asymmetric(Config::bca()::class);

        $this->assertIsString($res);
        $this->assertNotEmpty($res);
    }

    function testSymmetric()
    {
        Config::bca(Fixture::configFixture());
        $res = Signature::symmetric(
            Config::bca()::class,
            'POST',
            '/api/path',
            ['name' => 'otnansirk'],
            currentTimestamp(),
            'accessToken'
        );

        $this->assertIsString($res);
        $this->assertNotEmpty($res);
    }
}