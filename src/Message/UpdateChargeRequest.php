<?php

/**
 * Stripe Update Charge Request.
 */
namespace Omnipay\Stripe\Message;

/**
 * Stripe Update Charge Request.
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/charges/update
 */
class UpdateChargeRequest extends AuthorizeRequest
{
    public function getData()
    {
        $this->validate('transactionReference');

        $data = array();

        if ($this->getDescription()) {
            $data['description'] = $this->getDescription();
        }

        if ($this->getCustomerReference()) {
            $data['customer'] = $this->getCustomerReference();
        }

        if ($this->getMetadata()) {
            $data['metadata'] = $this->getMetadata();
        }

        if ($this->getReceiptEmail()) {
            $data['receipt_email'] = $this->getReceiptEmail();
        }

        if ($this->getTransferGroup()) {
            $data['transfer_group'] = $this->getTransferGroup();
        }

        // Filter out the empty/non-updated values
        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/charges/'.$this->getTransactionReference();
    }
}
