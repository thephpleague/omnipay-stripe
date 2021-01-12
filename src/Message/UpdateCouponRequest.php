<?php

namespace Omnipay\Stripe\Message;

/**
 * Stripe Update Coupon Request
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/coupons/update
 */
class UpdateCouponRequest extends AbstractRequest
{
    /**
     * Get the coupon
     *
     * @return string
     */
    public function getCouponId()
    {
        return $this->getParameter('couponId');
    }

    /**
     * Set the coupon
     *
     * @param $value
     * @return UpdateCouponRequest
     */
    public function setCouponId($value)
    {
        return $this->setParameter('couponId', $value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getParameter('name');
    }

    /**
     * @param string $value
     *
     * @return UpdateCouponRequest
     */
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    public function getData()
    {
        $data = array();

        if (null !== $this->getName()) {
            $data['name'] = $this->getName();
        }

        if ($this->getMetadata()) {
            $data['metadata'] = $this->getMetadata();
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/coupons/'.$this->getCouponId();
    }

    public function getHttpMethod()
    {
        return 'POST';
    }
}
