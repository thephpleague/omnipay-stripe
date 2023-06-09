<?php namespace Omnipay\Stripe\Message\Checkout;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Stripe Checkout Response - https://stripe.com/docs/api/checkout/sessions/create
 *
 * @see \Omnipay\Stripe\Gateway
 */
class Response extends \Omnipay\Stripe\Message\Response
{
    /**
     * @return bool
     */
    public function isRedirect()
    {
        return $this->getRedirectUrl() !== null;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrl()
    {
        if (isset($this->data['object']) && 'checkout.session' !== $this->data['object']) {
            return null;
        }

        return !empty($this->data['url']) ? $this->data['url'] : null;
    }
}
