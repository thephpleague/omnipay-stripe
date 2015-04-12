<?php
/**
 * Stripe Update Credit Card Request
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Update Credit Card Request
 *
 * This needs further work and/or explanation because it requires
 * a customer ID.
 *
 * @link https://stripe.com/docs/api#update_card
 */
class UpdateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['description'] = $this->getDescription();

        if ($this->getSource()) {
            $data['source'] = $this->getSource();
        } elseif ($this->getToken()) {
            $data['source'] = $this->getToken();
        } elseif ($this->getCard()) {
            $data['source'] = $this->getCardData();
            $data['email'] = $this->getCard()->getEmail();
        }

        $this->validate('cardReference');

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/customers/'.$this->getCardReference();
    }
}
