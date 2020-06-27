<?php

/**
 * Stripe Fetch Subscription Request.
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Subscription Request.
 *
 * @link https://stripe.com/docs/api/subscription_schedules/retrieve
 */
class FetchSubscriptionSchedulesRequest extends AbstractRequest
{
    /**
     * Get the subscription reference.
     *
     * @return string
     */
    public function getSubscriptionSchedulesReference()
    {
        return $this->getParameter('subscriptionSchedulesReference');
    }

    /**
     * Set the subscription reference.
     *
     * @param $value
     * @return \Omnipay\Common\Message\AbstractRequest|FetchSubscriptionRequest
     */
    public function setSubscriptionSchedulesReference($value)
    {
        return $this->setParameter('subscriptionSchedulesReference', $value);
    }

    public function getData()
    {
        $this->validate('subscriptionSchedulesReference');

        return array();
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/subscription_schedules/'.$this->getSubscriptionSchedulesReference();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }
}
