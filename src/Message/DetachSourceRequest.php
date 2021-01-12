<?php

/**
 * Stripe Detach Source Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe Detach Source Request.
 *
 * Detaches a Source object from a Customer.
 * The status of a source is changed to consumed when it is detached and it can no longer be used to create a charge.
 *
 * @link https://stripe.com/docs/api/sources/detach
 */
class DetachSourceRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('customerReference', 'source');

        return;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/customers/'.$this->getCustomerReference().'/sources/'.$this->getSource();
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }
}
