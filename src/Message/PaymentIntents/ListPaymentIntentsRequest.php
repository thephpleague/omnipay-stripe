<?php

/**
 * Stripe List Payment Intents Request.
 */
namespace Omnipay\Stripe\Message\PaymentIntents;

use Omnipay\Stripe\Message\Response;

/**
 * Stripe List Payment Intents Request.
 *
 *  // Check if we're good!
 *  $paymentIntents = $gateway->listPaymentIntents();
 *
 *  $response = $paymentIntent->send();
 *
 *  if ($response->isSuccessful()) {
 *    // All done. Rejoice.
 *  }
 *
 * @link https://stripe.com/docs/api/payment_intents/list
 */
class ListPaymentIntentsRequest extends AbstractRequest
{
    /**
     * Set the limit parameter.
     *
     * @param $value
     */
    public function setLimit($value)
    {
        $this->setParameter('limit', $value);
    }

    /**
     * Get the limit parameter.
     *
     * @return mixed
     */
    public function getLimit()
    {
        return $this->getParameter('limit');
    }

    public function getData()
    {
        $data = array();

        if ($this->getLimit()) {
            $data['limit'] = $this->getLimit();
        }

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function getHttpMethod()
    {
        return 'GET';
    }

    /**
     * @inheritdoc
     */
    public function getEndpoint()
    {
        return $this->endpoint . '/payment_intents';
    }

    /**
     * @inheritdoc
     */
    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}
