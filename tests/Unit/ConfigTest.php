<?php
use Otnansirk\SnapBI\Fixtures\Fixture;
use Otnansirk\SnapBI\Services\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    function testThrowSnapBiException()
    {
        $this->expectException(\Otnansirk\SnapBI\Exception\SnapBiException::class);
        Config::bank(Fixture::configFixture());
    }
    function testThrowInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        Config::bca([]);
    }

    function testRegister()
    {
        Config::bca(Fixture::configFixture());
        $this->assertArrayHasKey("client_id", Config::bca()->all());
        $this->assertArrayHasKey("client_id", Config::for('bca')->all());
    }

    function testGet()
    {
        $this->assertArrayHasKey("client_id", Config::bca()->all());
        $this->assertArrayHasKey("client_id", Config::for('bca')->all());
    }
    function testAll()
    {
        $this->assertNotEmpty(Config::bca()->all());
        $this->assertNotEmpty(Config::for('bca')->all());
    }
}