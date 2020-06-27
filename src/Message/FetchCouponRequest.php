<?php

namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Coupon Request
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/coupons/retrieve
 */
class FetchCouponRequest extends AbstractRequest
{
    /**
     * Get the coupon id.
     *
     * @return string
     */
    public function getCouponId()
    {
        return $this->getParameter('couponId');
    }

    /**
     * Set the coupon id.
     *
     * @param string
     * @return FetchCouponRequest provides a fluent interface.
     */
    public function setCouponId($value)
    {
        return $this->setParameter('couponId', $value);
    }

    public function getData()
    {
        $this->validate('couponId');
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/coupons/'.$this->getCouponId();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }
}
