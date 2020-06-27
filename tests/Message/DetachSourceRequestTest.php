<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class DetachSourceRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new DetachSourceRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setSource('src_1GyjQZK1civsTrrUGHtiV3AN');
        $this->request->setCustomerReference('cus_HVUs00WcT4j06R');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/customers/cus_HVUs00WcT4j06R/sources/src_1GyjQZK1civsTrrUGHtiV3AN', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('DetachSourceSuccess.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotNull($response->getSource());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('DetachSourceFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getSourceId());
        $this->assertSame('No such source: src_1Gyk9dK1civsTrCUNB7v9XoFo', $response->getMessage());
    }
}
