<?php

/**
 * Stripe Cancel Subscription Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe Cancel Subscription Request.
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/subscriptions/cancel
 */
class CancelSubscriptionRequest extends AbstractRequest
{
    /**
     * Get the subscription reference.
     *
     * @return string
     */
    public function getSubscriptionReference()
    {
        return $this->getParameter('subscriptionReference');
    }

    /**
     * Set the set subscription reference.
     *
     * @param string $value
     *
     * @return CancelSubscriptionRequest provides a fluent interface.
     */
    public function setSubscriptionReference($value)
    {
        return $this->setParameter('subscriptionReference', $value);
    }

    public function getData()
    {
        $this->validate('subscriptionReference');

        return array();
    }

    public function getEndpoint()
    {
        return $this->getCustomerReference() ?
            $this->endpoint
                .'/customers/'.$this->getCustomerReference()
                .'/subscriptions/'.$this->getSubscriptionReference() :
            $this->endpoint.'/subscriptions/'.$this->getSubscriptionReference();
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }
}
