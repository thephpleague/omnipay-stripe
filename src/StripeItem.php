<?php
/**
 * Stripe Item
 */

namespace Omnipay\Stripe;

use Omnipay\Common\Item;

/**
 * Class StripeItem
 *
 * @package Omnipay\Stripe
 */
class StripeItem extends Item
{
    public function getTaxes()
    {
        return $this->getParameter('taxes');
    }

    public function setTaxes($value)
    {
        $this->setParameter('taxes', $value);
    }

    public function getDiscount()
    {
        return $this->getParameter('discount');
    }

    public function setDiscount($value)
    {
        $this->setParameter('discount', $value);
    }
}
