<?php

/**
 * Stripe Fetch Source Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe Fetch Source Request.
 *
 * @link https://stripe.com/docs/api/sources/retrieve
 */
class FetchSourceRequest extends AbstractRequest
{
    /**
     * @return string|null
     */
    public function getClientSecret()
    {
        return $this->getParameter('clientSecret');
    }

    /**
     * @param string $value
     *
     * @return FetchSourceRequest
     */
    public function setClientSecret($value)
    {
        return $this->setParameter('clientSecret', $value);
    }

    public function getData()
    {
        $this->validate('source');
        $data = array();

        if ($clientSecret = $this->getClientSecret()) {
            $data['client_secret'] = $clientSecret;
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/sources/'.$this->getSource();
    }

    public function getHttpMethod()
    {
        return 'GET';
    }
}
