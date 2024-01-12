<?php

/**
 * Stripe Capture Request.
 */
namespace Omnipay\Stripe\Message\PaymentIntents;

use Money\Formatter\DecimalMoneyFormatter;

/**
 * Stripe Capture Request.
 *
 * Use this request to capture and process a previously created authorization.
 *
 * Example -- note this example assumes that the authorization has been successful
 * and that the payment intent that performed the authorization is held in $paymentIntent.
 * See AuthorizeRequest for the first part of this example transaction:
 *
 * <code>
 *   // Once the transaction has been authorized, we can capture it for final payment.
 *   $transaction = $gateway->capture(array(
 *       'amount'        => '10.00',
 *       'currency'      => 'AUD',
 *   ));
 *   $transaction->setPaymentMethod($paymentMethod);
 *   $response = $transaction->send();
 * </code>
 *
 * @see AuthorizeRequest
 * @link https://stripe.com/docs/api/payment_intents/capture
 */
class CaptureRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('paymentIntentReference');

        $data = array();

        if ($amount = $this->getAmountInteger()) {
            $data['amount_to_capture'] = $amount;
        }

        if ($this->getApplicationFee()) {
            $data['application_fee_amount'] = $this->getApplicationFeeInteger();
        }

        return $data;
    }

    /**
     * @return string
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getApplicationFee()
    {
        $money = $this->getMoney('applicationFee');

        if ($money !== null) {
            return (new DecimalMoneyFormatter($this->getCurrencies()))->format($money);
        }

        return '';
    }

    /**
     * Get the payment amount as an integer.
     *
     * @return integer
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getApplicationFeeInteger()
    {
        $money = $this->getMoney('applicationFee');

        if ($money !== null) {
            return (integer) $money->getAmount();
        }

        return 0;
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setApplicationFee($value)
    {
        return $this->setParameter('applicationFee', $value);
    }


    public function getEndpoint()
    {
        return $this->endpoint.'/payment_intents/'.$this->getPaymentIntentReference().'/capture';
    }

    /**
     * @inheritdoc
     */
    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}
