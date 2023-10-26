<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class CancelSubscriptionRequestTest extends TestCase
{
    /**
     * @var CancelSubscriptionRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = new CancelSubscriptionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setSubscriptionReference('sub_7mU0FokE8GQZFW');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/subscriptions/sub_7mU0FokE8GQZFW', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CancelSubscriptionSuccess.txt');
        $response = $this->request->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('sub_7mU0FokE8GQZFW', $response->getSubscriptionReference());
        $this->assertNotNull($response->getPlan());
        $this->assertNull($response->getMessage());
    }


    public function testSendError()
    {
        $this->setMockHttpResponse('CancelSubscriptionFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getSubscriptionReference());
        $this->assertNull($response->getPlan());
        $this->assertSame("No such subscription: 'sub_7mU0FokE8GQZFW'", $response->getMessage());
    }
}
