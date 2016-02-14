<?php

/**
 * Stripe Update Subscription Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe Update Subscription Request
 *
 * @see Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api#update_subscription
 */
class UpdateSubscriptionRequest extends AbstractRequest
{
    /**
     * Get the plan ID
     *
     * @return string
     */
    public function getPlanId()
    {
        return $this->getParameter('plan');
    }

    /**
     * Set the plan ID
     *
     * @return UpdateSubscriptionRequest provides a fluent interface.
     */
    public function setPlanId($value)
    {
        return $this->setParameter('plan', $value);
    }

    /**
     * Set the subscription reference
     *
     * @return UpdateSubscriptionRequest provides a fluent interface.
     */
    public function setSubscriptionReference($value)
    {
        return $this->setParameter('subscriptionReference', $value);
    }

    /**
     * Get the subscription reference
     *
     * @return string
     */
    public function getSubscriptionReference()
    {
        return $this->getParameter('subscriptionReference');
    }

    public function getData()
    {
        $this->validate('customerReference', 'subscriptionReference', 'plan');

        $data = array(
            'plan' => $this->getPlanId()
        );

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/customers/'.$this->getCustomerReference()
                .'/subscriptions/'.$this->getSubscriptionReference();
    }
}
