<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class UpdateChargeRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new UpdateChargeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransactionReference('foo');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/charges/foo', $this->request->getEndpoint());
    }

    public function testData()
    {
        $this->request->setDescription('New customer');
        $this->request->setCustomerReference('cus_1MZeNih5LdKxDq');
        $this->request->setReceiptEmail('customer@business.dom');
        $this->request->setTransferGroup('test');
        $this->request->setMetadata(array('field' => 'value'));

        $data = $this->request->getData();

        $this->assertSame('cus_1MZeNih5LdKxDq', $data['customer']);
        $this->assertSame('customer@business.dom', $data['receipt_email']);
        $this->assertSame('New customer', $data['description']);
        $this->assertArrayHasKey('field', $data['metadata']);
        $this->assertSame('value', $data['metadata']['field']);
        $this->assertSame('test', $data['transfer_group']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('UpdateChargeSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('ch_1E0Pt92eZvKYlo2C05QSmQvw', $response->getTransactionReference());
        $this->assertSame('cus_1MZeNih5LdKxDq', $response->getCustomerReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('UpdateChargeFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getCustomerReference());
        $this->assertSame('No such charge: ch_1E0Pt92eZvKYlo2C0QSmQvw', $response->getMessage());
    }
}
