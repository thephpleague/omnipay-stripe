<?php

namespace Omnipay\Stripe\Message\PaymentIntents;

use Omnipay\Tests\TestCase;

class FetchPaymentMethodsRequestTest extends TestCase
{
    /** @var FetchPaymentMethodsRequest */
    public $request;

    public function setUp()
    {
        $this->request = new FetchPaymentMethodsRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setCustomerReference('cus_HJ8fYBDCaIUzgi');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/payment_methods', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchPaymentMethodsSuccess.txt');
        $response = $this->request->send();
        $data = $response->getData();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('pm_1GsOJg2eZvKYlo2CrMsVzvX8', $data['data'][0]['id']);
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('FetchPaymentMethodsFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getCustomerReference());
        $this->assertSame('No such customer: cus_HJ8fYBDCaIUzgi', $response->getMessage());
    }
}
