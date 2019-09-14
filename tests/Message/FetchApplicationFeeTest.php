<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class FetchApplicationFeeTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchApplicationFeeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setApplicationFeeReference('fee_1FITlv123YJsynqe3nOIfake');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/application_fees/fee_1FITlv123YJsynqe3nOIfake', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchApplicationFeeSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('fee_1FITlv123YJsynqe3nOIfake', $response->getApplicationFeeReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('FetchApplicationFeeFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getApplicationFeeReference());
        $this->assertSame('No such application fee: fee_1FITlv123YJsynqe3nOIfake', $response->getMessage());
    }
}
