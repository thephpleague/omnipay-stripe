<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class UpdateCouponRequestTest extends TestCase
{
    /**
     * @var UpdateCouponRequest
     */
    protected $request;

    public function setUp()
    {
        $this->request = new UpdateCouponRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setCouponId('50_OFF');
        $this->request->setName('50% Discount');
    }

    public function testEndpoint()
    {
        $endpoint = 'https://api.stripe.com/v1/coupons/50_OFF';
        $this->assertSame($endpoint, $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('UpdateCouponSuccess.txt');
        /** @var Response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('50_OFF', $response->getCouponId());
        $this->assertNotNull($response->getCoupon());
        $this->assertNull($response->getMessage());
    }


    public function testSendError()
    {
        $this->setMockHttpResponse('UpdateCouponFailure.txt');

        /** @var Response */
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCouponId());
        $this->assertNull($response->getCoupon());
        $this->assertSame('No such coupon: 50_OFF', $response->getMessage());
    }
}
