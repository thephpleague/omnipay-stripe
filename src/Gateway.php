<?php

/**
 * Stripe Charge Gateway.
 */
namespace Omnipay\Stripe;

/**
 * Stripe Charge Gateway.
 *
 * @see \Omnipay\Stripe\AbstractGateway
 * @see \Omnipay\Stripe\Message\AbstractRequest
 *
 * @link https://stripe.com/docs/api
 *
 */
class Gateway extends AbstractGateway
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Stripe Charge';
    }

    /**
     * @inheritdoc
     *
     * @return \Omnipay\Stripe\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\AuthorizeRequest', $parameters);
    }

    /**
     * @inheritdoc
     *
     * @return \Omnipay\Stripe\Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\CaptureRequest', $parameters);
    }

    /**
     * @inheritdoc
     *
     * @return \Omnipay\Stripe\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\PurchaseRequest', $parameters);
    }

    /**
     * @deprecated 2.3.3:3.0.0 duplicate of \Omnipay\Stripe\Gateway::fetchTransaction()
     * @see \Omnipay\Stripe\Gateway::fetchTransaction()
     * @param array $parameters
     * @return \Omnipay\Stripe\Message\FetchChargeRequest
     */
    public function fetchCharge(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\FetchChargeRequest', $parameters);
    }

    //
    // Cards
    // @link https://stripe.com/docs/api#cards
    //

    /**
     * @inheritdoc
     *
     * @return \Omnipay\Stripe\Message\CreateCardRequest
     */
    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\CreateCardRequest', $parameters);
    }

    /**
     * @inheritdoc
     *
     * @return \Omnipay\Stripe\Message\UpdateCardRequest
     */
    public function updateCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\UpdateCardRequest', $parameters);
    }

    /**
     * @inheritdoc
     *
     * @return \Omnipay\Stripe\Message\DeleteCardRequest
     */
    public function deleteCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\DeleteCardRequest', $parameters);
    }

    //
    // Tokens
    // @link https://stripe.com/docs/api#tokens
    //

    /**
     * Creates a single use token that wraps the details of a credit card.
     * This token can be used in place of a credit card associative array with any API method.
     * These tokens can only be used once: by creating a new charge object, or attaching them to a customer.
     *
     * This kind of token is also useful when sharing clients between one platform and a connect account.
     * Use this request to create a new token to make a direct charge on a customer of the platform.
     *
     * @param array $parameters parameters to be passed in to the TokenRequest.
     * @return \Omnipay\Stripe\Message\CreateTokenRequest The create token request.
     */
    public function createToken(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\CreateTokenRequest', $parameters);
    }

    /**
     * Stripe Fetch Token Request.
     *
     * Often you want to be able to charge credit cards or send payments
     * to bank accounts without having to hold sensitive card information
     * on your own servers. Stripe.js makes this easy in the browser, but
     * you can use the same technique in other environments with our token API.
     *
     * Tokens can be created with your publishable API key, which can safely
     * be embedded in downloadable applications like iPhone and Android apps.
     * You can then use a token anywhere in our API that a card or bank account
     * is accepted. Note that tokens are not meant to be stored or used more
     * than once—to store these details for use later, you should create
     * Customer or Recipient objects.
     *
     * @param array $parameters
     *
     * @return \Omnipay\Stripe\Message\FetchTokenRequest
     */
    public function fetchToken(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Stripe\Message\FetchTokenRequest', $parameters);
    }
}
