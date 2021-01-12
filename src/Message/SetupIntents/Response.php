<?php

/**
 * Stripe Payment Intents Response.
 */

namespace Omnipay\Stripe\Message\SetupIntents;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Stripe\Message\Response as BaseResponse;

/**
 * Stripe Payment Intents Response.
 *
 * This is the response class for all payment intents related responses.
 *
 * @see \Omnipay\Stripe\PaymentIntentsGateway
 */
class Response extends BaseResponse implements ResponseInterface
{
    /**
     * Get the status of a payment intents response.
     *
     * @return string|null
     */
    public function getStatus()
    {
        if (isset($this->data['object']) && 'setup_intent' === $this->data['object']) {
            return $this->data['status'];
        }

        return null;
    }

    /**
     * Return true if the payment intent requires confirmation.
     *
     * @return bool
     */
    public function requiresConfirmation()
    {
        return $this->getStatus() === 'requires_confirmation';
    }

    /**
     * @inheritdoc
     */
    public function getClientSecret()
    {
        if (isset($this->data['object']) && 'setup_intent' === $this->data['object']) {
            if (!empty($this->data['client_secret'])) {
                return $this->data['client_secret'];
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function getCustomerReference()
    {

        if (isset($this->data['object']) && 'setup_intent' === $this->data['object']) {
            if (!empty($this->data['customer'])) {
                return $this->data['customer'];
            }
        }

        return parent::getCustomerReference();
    }

    /**
     * @inheritdoc
     */
    public function isSuccessful()
    {
        if (isset($this->data['object']) && 'setup_intent' === $this->data['object']) {
            return in_array($this->getStatus(), ['succeeded', 'requires_payment_method']);
        }

        return parent::isSuccessful();
    }

    /**
     * @inheritdoc
     */
    public function isCancelled()
    {
        if (isset($this->data['object']) && 'setup_intent' === $this->data['object']) {
            return $this->getStatus() === 'canceled';
        }

        return parent::isCancelled();
    }

    /**
     * @inheritdoc
     */
    public function isRedirect()
    {
        if ($this->getStatus() === 'requires_action' || $this->getStatus() === 'requires_source_action') {
            // Currently this gateway supports only manual confirmation, so any other
            // next action types pretty much mean a failed transaction for us.
            return (!empty($this->data['next_action']) && $this->data['next_action']['type'] === 'redirect_to_url');
        }

        return parent::isRedirect();
    }

    /**
     * @inheritdoc
     */
    public function getRedirectUrl()
    {
        return $this->isRedirect() ? $this->data['next_action']['redirect_to_url']['url'] : parent::getRedirectUrl();
    }

    /**
     * Get the payment intent reference.
     *
     * @return string|null
     */
    public function getSetupIntentReference()
    {
        if (isset($this->data['object']) && 'setup_intent' === $this->data['object']) {
            return $this->data['id'];
        }

        return null;
    }

    /**
     * Get the payment intent reference.
     *
     * @return string|null
     */
    public function getPaymentMethod()
    {
        if (isset($this->data['object']) && 'setup_intent' === $this->data['object']) {
            return $this->data['payment_method'];
        }

        return null;
    }
}
