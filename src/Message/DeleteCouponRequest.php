<?php

namespace Omnipay\Stripe\Message;

/**
 * Stripe Delete Coupon Request
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/coupons/delete
 */
class DeleteCouponRequest extends AbstractRequest
{
    /**
     * Get the source id.
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
     * @param string $value
     *
     * @return DeleteCouponRequest provides a fluent interface
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
        return 'DELETE';
    }
}
