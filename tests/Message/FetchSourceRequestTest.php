<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class FetchSourceRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchSourceRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setSource('src_1GyjQZK1civsTrrUGHtiV3AN');
        $this->request->setClientSecret('src_client_secret_kO8U38RMu0NedTxDoTkOJbTc');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/sources/src_1GyjQZK1civsTrrUGHtiV3AN', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchSourceSuccess.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertSame('src_1GyjQZK1civsTrrUGHtiV3AN', $response->getSourceId());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('FetchSourceFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getSource());
        $this->assertNull($response->getSourceId());
        $this->assertSame('No such source: src_1GyjQZK1civsTrrUGHtiV3ANo', $response->getMessage());
    }
}
