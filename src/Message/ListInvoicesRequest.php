<?php

/**
 * Stripe List Invoices Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe List Invoices Request.
 *
 * @see Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api#list_invoices
 */
class ListInvoicesRequest extends AbstractRequest
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
     * @return CancelSubscriptionRequest provides a fluent interface.
     */
    public function setSubscriptionReference($value)
    {
        return $this->setParameter('subscriptionReference', $value);
    }

    public function getData()
    {
        $this->validate('customerReference', 'subscriptionReference');

        $data = array();

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint
            .'/customers/'.$this->getCustomerReference()
            .'/subscriptions/'.$this->getSubscriptionReference();
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }
}
