<?php


namespace Omnipay\Stripe\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Message which creates a new card token, or in a Connect API
 * workflow can be used to share clients between the platform and
 * the connected accounts.
 *
 * Creates a single use token that wraps the details of a credit card.
 * This token can be used in place of a credit card dictionary with any API method.
 * These tokens can only be used once: by creating a new charge object, or attaching them to a customer.
 *
 * In most cases, you should create tokens client-side using Checkout, Elements, or our mobile libraries,
 * instead of using the API.
 *
 * @link https://stripe.com/docs/api#create_card_token
 */
class CreateTokenRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     *
     * @param \Omnipay\Common\CreditCard $value Credit card object
     * @return \Omnipay\Common\Message\AbstractRequest $this
     */
    public function setCard($value)
    {
        return parent::setCard($value);
    }

    /**
     * The id of the customer with format cus_<identifier>.
     * <strong>Only use this if you are using Connect API</strong>
     *
     * @param string $customer The id of the customer
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Stripe\Message\CreateTokenRequest
     */
    public function setCustomer($customer)
    {
        return $this->setParameter('customer', $customer);
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $data = array();

        if ($this->getParameter('customer')) {
            $data['customer'] = $this->getParameter('customer');
        } elseif ($this->getParameter('card')) {
            $data['card'] = $this->getParameter('card');
        } else {
            throw new InvalidRequestException("You must pass either the card or the customer");
        }

        return $data;
    }

    /**
     * @inheritdoc
     *
     * @return string The endpoint for the create token request.
     */
    public function getEndpoint()
    {
        return $this->endpoint . '/tokens';
    }
}
