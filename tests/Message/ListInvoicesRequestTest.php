<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class ListInvoicesRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new ListInvoicesRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/invoices', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ListInvoicesSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotNull($response->getList());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('ListInvoicesFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getList());
        $this->assertSame('Invalid API Key provided: sk_test_1234567890ABCDEFlfQ0', $response->getMessage());
    }
}
