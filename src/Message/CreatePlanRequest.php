<?php

/**
 * Stripe Create Plan Request.
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Create Plan Request
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/plans/create
 */
class CreatePlanRequest extends AbstractRequest
{
    /**
     * Set the plan ID
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setId($value)
    {
        return $this->setParameter('id', $value);
    }

    /**
     * Get the plan ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getParameter('id');
    }

    /**
     * Set the plan interval
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setInterval($value)
    {
        return $this->setParameter('interval', $value);
    }

    /**
     * Get the plan interval
     *
     * @return int
     */
    public function getInterval()
    {
        return $this->getParameter('interval');
    }

    /**
     * Set the plan interval count
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setIntervalCount($value)
    {
        return $this->setParameter('interval_count', $value);
    }

    /**
     * Get the plan interval count
     *
     * @return int
     */
    public function getIntervalCount()
    {
        return $this->getParameter('interval_count');
    }

    /**
     * Set the plan name
     * @deprecated use setNickname() instead
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setName($value)
    {
        return $this->setNickname($value);
    }

    /**
     * Get the plan name
     * @deprecated use getNickname() instead
     *
     * @return string
     */
    public function getName()
    {
        return $this->getNickname();
    }

    /**
     * Set the plan statement descriptor
     * @deprecated Not used anymore
     *
     * @param $planStatementDescriptor
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setStatementDescriptor($planStatementDescriptor)
    {
        return $this->setParameter('statement_descriptor', $planStatementDescriptor);
    }

    /**
     * Get the plan statement descriptor
     * @deprecated Not used anymore
     *
     * @return string
     */
    public function getStatementDescriptor()
    {
        return $this->getParameter('statement_descriptor');
    }

    /**
     * Set the plan product
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setProduct($value)
    {
        return $this->setParameter('product', $value);
    }

    /**
     * Get the plan product
     *
     * @return string|array
     */
    public function getProduct()
    {
        return $this->getParameter('product');
    }

    /**
     * Set the plan amount
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', (integer)$value);
    }

    /**
     * Get the plan amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * Set the plan tiers
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setTiers($value)
    {
        return $this->setParameter('tiers', $value);
    }

    /**
     * Get the plan tiers
     *
     * @return int
     */
    public function getTiers()
    {
        return $this->getParameter('tiers');
    }

    /**
     * Set the plan tiers mode
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setTiersMode($value)
    {
        return $this->setParameter('tiers_mode', $value);
    }

    /**
     * Get the plan tiers mode
     *
     * @return int
     */
    public function getTiersMode()
    {
        return $this->getParameter('tiers_mode');
    }

    /**
     * Set the plan nickname
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setNickname($value)
    {
        return $this->setParameter('nickname', $value);
    }

    /**
     * Get the plan nickname
     *
     * @return string|array
     */
    public function getNickname()
    {
        return $this->getParameter('nickname');
    }

    /**
     * Set the plan metadata
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setMetadata($value)
    {
        return $this->setParameter('metadata', $value);
    }

    /**
     * Get the plan metadata
     *
     * @return string|array
     */
    public function getMetadata()
    {
        return $this->getParameter('metadata');
    }

    /**
     * Set the plan active
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setActive($value)
    {
        return $this->setParameter('active', $value);
    }

    /**
     * Get the plan active
     *
     * @return string|array
     */
    public function getActive()
    {
        return $this->getParameter('active');
    }

    /**
     * Set the plan billingScheme
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setBillingScheme($value)
    {
        return $this->setParameter('billing_scheme', $value);
    }

    /**
     * Get the plan billingScheme
     *
     * @return string|array
     */
    public function getBillingScheme()
    {
        return $this->getParameter('billing_scheme');
    }

    /**
     * Set the plan aggregate usage
     *
     * @param $planAggregateUsage
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setAggregateUsage($planAggregateUsage)
    {
        return $this->setParameter('aggregate_usage', $planAggregateUsage);
    }

    /**
     * Get the plan aggregate usage
     *
     * @return string
     */
    public function getAggregateUsage()
    {
        return $this->getParameter('aggregate_usage');
    }

    /**
     * Set the plan trial period days
     *
     * @param $planTrialPeriodDays
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setTrialPeriodDays($planTrialPeriodDays)
    {
        return $this->setParameter('trial_period_days', $planTrialPeriodDays);
    }

    /**
     * Get the plan trial period days
     *
     * @return int
     */
    public function getTrialPeriodDays()
    {
        return $this->getParameter('trial_period_days');
    }

    /**
     * Set the plan transform usage
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setTransformUsage($value)
    {
        return $this->setParameter('transform_usage', $value);
    }

    /**
     * Get the plan transform usage
     *
     * @return int
     */
    public function getTransformUsage()
    {
        return $this->getParameter('transform_usage');
    }

    /**
     * Set the plan usage type
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|CreatePlanRequest
     */
    public function setUsageType($value)
    {
        return $this->setParameter('usage_type', $value);
    }

    /**
     * Get the plan usage type
     *
     * @return int
     */
    public function getUsageType()
    {
        return $this->getParameter('usage_type');
    }

    public function getData()
    {
        $this->validate('currency', 'interval', 'product');

        if (null == $this->getBillingScheme() || 'per_unit' == $this->getBillingScheme()) {
            $this->validate('amount');
        } elseif ('tiered' == $this->getBillingScheme()) {
            $this->validate('tiers', 'tiers_mode');
        }

        $data = array(
            'currency' => $this->getCurrency(),
            'interval' => $this->getInterval(),
            'product' => $this->getProduct()
        );

        if (null != $this->getBillingScheme()) {
            $data['billing_scheme'] = $this->getBillingScheme();
        }

        if (null != $this->getId()) {
            $data['id'] = $this->getId();
        }

        if (null != $this->getAmount()) {
            $data['amount'] = $this->getAmount();
        }

        if (null != $this->getNickName()) {
            $data['nickname'] = $this->getNickName();
        }

        if (null != $this->getMetadata()) {
            $data['metadata'] = $this->getMetadata();
        }

        if (null != $this->getActive()) {
            $data['active'] = $this->getActive();
        }

        if (null != $this->getIntervalCount()) {
            $data['interval_count'] = $this->getIntervalCount();
        }

        if (null != $this->getAggregateUsage()) {
            $data['aggregate_usage'] = $this->getAggregateUsage();
        }

        if (null != $this->getTrialPeriodDays()) {
            $data['trial_period_days'] = $this->getTrialPeriodDays();
        }

        if (null != $this->getTransformUsage()) {
            $data['transform_usage'] = $this->getTransformUsage();
        }

        if (null != $this->getUsageType()) {
            $data['usage_type'] = $this->getUsageType();
        }

        if (null != $this->getTiers()) {
            $data['tiers'] = $this->getTiers();
        }

        if (null != $this->getTiersMode()) {
            $data['tiers_mode'] = $this->getTiersMode();
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/plans';
    }
}
