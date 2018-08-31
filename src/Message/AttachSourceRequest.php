<?php

/**
 * Stripe Attach Source Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe Attach Source Request.
 *
 *
 * @link https://stripe.com/docs/api#attach_source
 */
class AttachSourceRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('customerReference');
        $this->validate('source');

        $data['source'] = $this->getSource();

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint . '/customers/' . $this->getCustomerReference() . '/sources';
    }
}
