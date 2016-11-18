<?php namespace Trademe\Tests\Api;

use Http\Client\HttpClient;
use Trademe\Client;
use Trademe\Tests\TrademeTestCase;

abstract class TestCase extends TrademeTestCase
{
    /**
     * @return string
     */
    abstract protected function getApiClass();

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getApiMock()
    {
        $httpClient = $this->getMockBuilder(HttpClient::class)
                           ->setMethods(['sendRequest'])
                           ->getMock();
        $httpClient->expects($this->any())
                   ->method('sendRequest');

        $client = new Client($httpClient);
        
        return $this->getMockBuilder($this->getApiClass())
                    ->setMethods(['get', 'post', 'postRaw', 'patch', 'delete', 'put', 'head'])
                    ->setConstructorArgs([$client])
                    ->getMock();
    }
}
