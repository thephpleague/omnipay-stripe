<?php

/**
 * Stripe Fetch Application Fee Request.
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Application Fee Request.
 *
 * Example -- note this example assumes that an application fee has been successful.
 *
 * <code>
 *   // Fetch the transaction so that details can be found for refund, etc.
 *   $transaction = $gateway->fetchApplicationFee();
 *   $transaction->setApplicationFeeReference($application_fee_id);
 *   $response = $transaction->send();
 *   $data = $response->getData();
 *   echo "Gateway fetchApplicationFee response data == " . print_r($data, true) . "\n";
 * </code>
 *
 * @see \Omnipay\Stripe\Gateway
 *
 * @link https://stripe.com/docs/api#retrieve_application_fee
 */
class FetchApplicationFeeRequest extends AbstractRequest
{
    /**
     * Get the application fee reference
     *
     * @return string
     */
    public function getApplicationFeeReference()
    {
        return $this->getParameter('applicationFeeReference');
    }

    /**
     * Set the application fee reference
     *
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setApplicationFeeReference($value)
    {
        return $this->setParameter('applicationFeeReference', $value);
    }

    public function getData()
    {
        $this->validate('applicationFeeReference');

        $data = array();

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint . '/application_fees/' . $this->getApplicationFeeReference();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }
}
