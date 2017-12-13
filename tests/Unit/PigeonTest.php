<?php

namespace Test\Unit;

use \PHPUnit\Framework\TestCase;
use RoundPartner\Pigeon\Pigeon;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class PigeonTest extends TestCase
{

    /**
     * @var Pigeon
     */
    protected $instance;

    public function setUp()
    {
        $this->instance = new Pigeon('http://0.0.0.0:3411');
    }

    /**
     * @param Response[] $responses
     *
     * @throws \RoundPartner\Pigeon\Exception
     *
     * @dataProvider \Test\Provider\ResponseProvider::sendEmailSuccessfully()
     */
    public function testSendAnEmail($responses)
    {
        $client = $this->getClientMock($responses);
        $this->instance->setClient($client);
        $response = $this->instance->sendEmail('sender@mailinator.com', 'reciptient@mailinator.com', 'Hello World', 'You would not believe that this was sent by Go!');
        $this->assertTrue($response);
    }

    /**
     * @param Response[] $responses
     *
     * @return Client
     */
    protected function getClientMock($responses)
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        return $client;
    }
}