<?php

namespace Omnipay\Stripe\Message\Checkout;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'client_reference_id' => 'cart_id_123'
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame('cart_id_123', $data['client_reference_id']);
    }

}
