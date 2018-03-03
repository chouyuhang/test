<?php
namespace LINE\Tests\LINEBot;
use LINE\LINEBot;
use LINE\Tests\LINEBot\Util\DummyHttpClient;
class GetProfileTest extends \PHPUnit_Framework_TestCase
{
    public function testGetProfile()
    {
        $mock = function ($testRunner, $httpMethod, $url, $data) {
            /** @var \PHPUnit_Framework_TestCase $testRunner */
            $testRunner->assertEquals('GET', $httpMethod);
            $testRunner->assertEquals('https://api.line.me/v2/bot/profile/USER_ID', $url);
            return [
                'displayName' => 'BOT API',
                'userId' => 'userId',
                'pictureUrl' => 'https://example.com/abcdefghijklmn',
                'statusMessage' => 'Hello, LINE!',
            ];
        };
        $bot = new LINEBot(new DummyHttpClient($this, $mock), ['channelSecret' => 'a7e8c58d4744adbc363c42bc558db89e']);
        $res = $bot->getProfile('USER_ID');
        $this->assertEquals(200, $res->getHTTPStatus());
        $this->assertTrue($res->isSucceeded());
        $data = $res->getJSONDecodedBody();
        $this->assertEquals('BOT API', $data['displayName']);
        $this->assertEquals('userId', $data['userId']);
        $this->assertEquals('https://example.com/abcdefghijklmn', $data['pictureUrl']);
        $this->assertEquals('Hello, LINE!', $data['statusMessage']);
    }
}
