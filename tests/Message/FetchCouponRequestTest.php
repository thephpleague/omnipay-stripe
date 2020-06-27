<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class FetchCouponRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchCouponRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setCouponId('50_OFF');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/coupons/50_OFF', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchCouponSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('50_OFF', $response->getCouponId());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('FetchCouponFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCoupon());
        $this->assertNull($response->getCouponId());
        $this->assertSame('No such coupon: 30_OFF', $response->getMessage());
    }
}
