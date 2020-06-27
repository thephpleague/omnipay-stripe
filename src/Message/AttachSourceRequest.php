<?php
/**
 * CreateSourceRequest
 */
namespace Omnipay\Stripe\Message;

/**
 * Class CreateSourceRequest
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
