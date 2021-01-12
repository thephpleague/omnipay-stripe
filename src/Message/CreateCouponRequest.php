<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Stripe Create Coupon Request
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/coupons/create
 */
class CreateCouponRequest extends AbstractRequest
{
    /**
     * @return int
     */
    public function getAmountOff()
    {
        return $this->getParameter('amount_off');
    }

    /**
     * @param int $value
     *
     * @return CreateCouponRequest
     */
    public function setAmountOff($value)
    {
        return $this->setParameter('amount_off', $value);
    }

    /**
     * @return int
     */
    public function getPercentOff()
    {
        return $this->getParameter('percent_off');
    }

    /**
     * @param int $value
     *
     * @return CreateCouponRequest
     */
    public function setPercentOff($value)
    {
        return $this->setParameter('percent_off', $value);
    }

    /**
     * @return int
     */
    public function getDurationInMonths()
    {
        return $this->getParameter('duration_in_months');
    }

    /**
     * @param int $value
     *
     * @return CreateCouponRequest
     */
    public function setDurationInMonths($value)
    {
        return $this->setParameter('duration_in_months', $value);
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
     * @return CreateCouponRequest
     */
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    /**
     * @return int
     */
    public function getMaxRedemptions()
    {
        return $this->getParameter('max_redemptions');
    }

    /**
     * @param int $value
     *
     * @return CreateCouponRequest
     */
    public function setMaxRedemptions($value)
    {
        return $this->setParameter('duration_in_months', $value);
    }

    /**
     * @return int
     */
    public function getRedeemBy()
    {
        return $this->getParameter('redeem_by');
    }

    /**
     * @param int $value
     *
     * @return CreateCouponRequest
     */
    public function setRedeemBy($value)
    {
        return $this->setParameter('redeem_by', $value);
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getParameter('id');
    }

    /**
     * @param string $value
     *
     * @return CreateCouponRequest
     */
    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->getParameter('duration');
    }

    /**
     * @param string $value
     *
     * @return CreateCouponRequest
     */
    public function setDuration($value)
    {
        return $this->setParameter('duration', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->validate('duration');

        $amountOff = $this->getAmountOff();
        $percentOff = $this->getPercentOff();

        if (!isset($amountOff) && !isset($percentOff)) {
            throw new InvalidRequestException("Either amount_off or percent_off is required");
        }

        $data = [
            'id'                 => $this->getId(),
            'duration'           => $this->getDuration(),
            'amount_off'         => $this->getAmountOff(),
            'currency'           => $this->getCurrency(),
            'duration_in_months' => $this->getDurationInMonths(),
            'name'               => $this->getName(),
            'max_redemptions'    => $this->getMaxRedemptions(),
            'percent_off'        => $this->getPercentOff(),
            'redeem_by'          => $this->getRedeemBy(),
        ];

        if ($this->getMetadata()) {
            $data['metadata'] = $this->getMetadata();
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/coupons';
    }

    public function getHttpMethod()
    {
        return 'POST';
    }
}
