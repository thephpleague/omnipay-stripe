<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class CreateCouponRequestTest extends TestCase
{
    /**
     * @var CreateCouponRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = new CreateCouponRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setId('50_OFF');
        $this->request->setDuration('repeating');
        $this->request->setCurrency('EUR');
        $this->request->setRedeemBy(1606460031);
        $this->request->setPercentOff(50);
        $this->request->setDurationInMonths(3);
        $this->request->setMaxRedemptions(10);
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/coupons', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateCouponSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('50_OFF', $response->getCouponId());
        $this->assertNotNull($response->getCoupon());
        $this->assertNull($response->getMessage());
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     * @expectedExceptionMessage Either amount_off or percent_off is required
     */
    public function testAmountPercentRequired()
    {
        $this->request->setPercentOff(null);
        $this->request->setAmountOff(null);
        $this->request->getData();
    }


    public function testSendError()
    {
        $this->setMockHttpResponse('CreateCouponFailure.txt');
        $response = $this->request->send();
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCoupon());
        $this->assertNull($response->getCouponId());
        $this->assertSame('Coupon already exists.', $response->getMessage());
    }
}
