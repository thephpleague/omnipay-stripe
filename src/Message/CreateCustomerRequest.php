<?php
/**
 * Stripe Create Customer Request
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Create Customer Request
 *
 * Customer objects allow you to perform recurring charges and
 * track multiple charges that are associated with the same customer.
 * The API allows you to create, delete, and update your customers.
 * You can retrieve individual customers as well as a list of all of
 * your customers. 
 *
 * @link https://stripe.com/docs/api#customers
 */
class CreateCustomerRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['description'] = $this->getDescription();

        if ($this->getToken()) {
            $data['card'] = $this->getToken();
        } elseif ($this->getCard()) {
            $data['card'] = $this->getCardData();
            $data['email'] = $this->getCard()->getEmail();
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint . '/customers';
    }
}
