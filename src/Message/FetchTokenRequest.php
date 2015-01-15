<?php

namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Token Request
 */
class FetchTokenRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('token');

        $data = array();

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/tokens/'.$this->getToken();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }
}
