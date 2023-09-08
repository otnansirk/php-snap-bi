<?php
use Otnansirk\SnapBI\Support\HttpResponse;
use PHPUnit\Framework\TestCase;
use Otnansirk\SnapBI\Support\Http;

final class SupportHttpTest extends TestCase
{
    function testHeaderFormated()
    {
        $cases = [
            "request"  => ["Authorization " => "Bearer Shdjdxsw"],
            "response" => "Authorization :Bearer Shdjdxsw"
        ];

        $res = Http::headerFormated($cases['request']);

        $this->assertEquals($cases['response'], $res[0]);
        $this->assertIsArray($res);
    }

    function testWithToken()
    {
        $res = Http::withToken('qwerty');
        $this->assertInstanceOf(Http::class, $res);
    }
}