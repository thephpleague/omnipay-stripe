<?php

/**
 * AttachSourceRequest
 */
namespace Omnipay\Stripe\Message;

/**
 * Class AttachSourceRequest
 *
 * @link https://stripe.com/docs/api#attach_source
 *
 * @link https://stripe.com/docs/api/sources/attach
 */
class AttachSourceRequest extends AbstractRequest
{
    /**
     * @return mixed
     */
    public function getData()
    {
        $this->validate('customerReference', 'source');
        $this->validate('source');

        $data['source'] = $this->getSource();

        return $data;
    }

    /**
     * @inheritdoc
     *
     * @return string The endpoint for the create token request.
     */
    public function getEndpoint()
    {
        return $this->endpoint . '/customers/' . $this->getCustomerReference() . '/sources';
    }
}
