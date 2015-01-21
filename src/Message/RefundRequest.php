<?php

namespace Omnipay\Stripe\Message;

/**
 * Stripe Refund Request
 */
class RefundRequest extends AbstractRequest
{
    public function getRefundApplicationFee()
    {
        return $this->getParameter('refundApplicationFee');
    }

    public function setRefundApplicationFee($value)
    {
        return $this->setParameter('refundApplicationFee', $value);
    }

    public function getData()
    {
        $this->validate('transactionReference', 'amount');

        $data = array();
        $data['amount'] = $this->getAmountInteger();

        if ($this->getRefundApplicationFee()) {
            $data['refund_application_fee'] = true;
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/charges/'.$this->getTransactionReference().'/refund';
    }
}
