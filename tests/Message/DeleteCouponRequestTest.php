<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class DeleteCouponRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new DeleteCouponRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setCouponId('50_OFF');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/coupons/50_OFF', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('DeleteCouponSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
        $this->assertTrue($response->getData()['deleted']);
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('DeleteCouponFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCouponId());
        $this->assertSame('No such coupon: 30_OFF', $response->getMessage());
    }
}
