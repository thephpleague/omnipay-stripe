<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class AttachSourceRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new AttachSourceRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setCustomerReference('cus_1MZSEtqSghKx99');
        $this->request->setSource('src_1MZSEtqSghKx99');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/customers/cus_1MZSEtqSghKx99/sources', $this->request->getEndpoint());
    }

    public function testHttpMethod()
    {
        $this->assertSame('POST', $this->request->getHttpMethod());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('AttachSourceSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('cus_1MZSEtqSghKx99', $response->getCustomerReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('AttachSourceFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getCustomerReference());
        $this->assertSame('No such token: hhh&rnr', $response->getMessage());
    }
}
