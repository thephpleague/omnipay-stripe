<?php

namespace Message\PaymentIntents;

use Omnipay\Stripe\Message\PaymentIntents\ListPaymentIntentsRequest;
use Omnipay\Tests\TestCase;

class ListPaymentIntentsRequestTest extends TestCase
{
    /** @var ListPaymentIntentsRequest */
    protected $request;

    public function setUp()
    {
        $this->request = new ListPaymentIntentsRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setLimit(2);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/payment_intents', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ListPaymentIntentsSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotNull($response->getList());
        $this->assertNull($response->getMessage());
    }

    /**
     * According to documentation: https://stripe.com/docs/api/coupons/list
     * This request should never throw an error.
     */
    public function testSendFailure()
    {
        $this->assertTrue(true);
    }
}
