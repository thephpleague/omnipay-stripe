<?php

/**
 * Stripe Create Subscription Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe Create Subscription Request
 *
 * @see Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/php#create_subscription
 */
class CreateSubscriptionRequest extends AbstractRequest
{
    /**
     * Get the plan ID
     *
     * @return string
     */
    public function getPlan()
    {
        return $this->getParameter('plan');
    }

    /**
     * Set the plan ID
     *
     * @return CreateSubscriptionRequest provides a fluent interface.
     */
    public function setPlan($value)
    {
        return $this->setParameter('plan', $value);
    }

    /**
     * Get the tax percent
     *
     * @return string
     */
    public function getTaxPercent()
    {
        return $this->getParameter('tax_percent');
    }

    /**
     * Set the tax percentage
     *
     * @return CreateSubscriptionRequest provides a fluent interface.
     */
    public function setTaxPercent($value)
    {
        return $this->setParameter('tax_percent', $value);
    }

    public function getData()
    {
        $this->validate('customerReference', 'plan');

        $data = array(
            'plan' => $this->getPlan()
        );

        if ($this->parameters->has('tax_percent')) {
            $data['tax_percent'] = (float)$this->getParameter('tax_percent');
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/customers/'.$this->getCustomerReference().'/subscriptions';
    }
}
