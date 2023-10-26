<?php

namespace Omnipay\Stripe\Message\PaymentIntents;

class FetchPaymentMethodsRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getData()
    {
        $data['customer'] = $this->getCustomerReference();
        $data['type'] = 'card';

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
        return $this->endpoint . '/payment_methods';
    }

    /**
     * @inheritdoc
     */
    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}
