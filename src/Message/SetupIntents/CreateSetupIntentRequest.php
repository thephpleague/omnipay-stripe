<?php

/**
 * Stripe Create Payment Method Request.
 */

namespace Omnipay\Stripe\Message\SetupIntents;

/**
 * Stripe create setup intent
 *
 * ### Example
 *
 * <code>
 *
 * </code>
 *
 * @see \Omnipay\Stripe\Message\PaymentIntents\AttachPaymentMethodRequest
 * @see \Omnipay\Stripe\Message\PaymentIntents\DetachPaymentMethodRequest
 * @see \Omnipay\Stripe\Message\PaymentIntents\UpdatePaymentMethodRequest
 * @link https://stripe.com/docs/api/setup_intents/create
 */
class CreateSetupIntentRequest extends AbstractRequest
{
    /**
     * @param bool $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setConfirm($value)
    {
        return $this->setParameter('confirm', $value);
    }

    /**
     * @return mixed
     */
    public function getConfirm()
    {
        if (is_null($this->getParameter('confirm'))) {
            return 'false';
        }
        return $this->getParameter('confirm');
    }

    /**
     * @param bool $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setUsage($value)
    {
        return $this->setParameter('usage', $value);
    }

    /**
     * @return mixed
     */
    public function getUsage()
    {
        if (is_null($this->getParameter('usage'))) {
            return 'off_session';
        }
        return $this->getParameter('usage');
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        $data = [];

        if ($this->getCustomerReference()) {
            $data['customer'] = $this->getCustomerReference();
        }
        if ($this->getDescription()) {
            $data['description'] = $this->getDescription();
        }

        if ($this->getMetadata()) {
            $data['metadata'] = $this->getMetadata();
        }
        if ($this->getPaymentMethod()) {
            $data['payment_method'] = $this->getPaymentMethod();
        }

        $data['confirm'] = $this->getConfirm();

        $data['usage'] = $this->getUsage();
        $data['payment_method_types'][] = 'card';

        return $data;
    }

    /**
     * @inheritdoc
     */
    public function getEndpoint()
    {
        return $this->endpoint . '/setup_intents';
    }

    /**
     * @inheritdoc
     */
    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}
