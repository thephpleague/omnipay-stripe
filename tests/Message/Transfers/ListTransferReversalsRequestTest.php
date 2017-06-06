<?php

namespace Omnipay\Stripe\Message\Transfers;

use Guzzle\Http\Message\Response;
use Omnipay\Tests\TestCase;

class ListTransferReversalsRequestTest extends TestCase
{

    /** @var ListTransferReversalsRequest */
    protected $request;

    public function setUp()
    {
        $this->request = new ListTransferReversalsRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setTransferReference('tr_164xRv2eZvKYlo2CZxJZWm1E');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/transfers/tr_164xRv2eZvKYlo2CZxJZWm1E/reversals', $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse(
            [Response::fromMessage(file_get_contents(__DIR__ . '/../../Mock/Transfers/ListTransferReversalsSuccess.txt'))]
        );

        /** @var \Omnipay\Stripe\Message\Response $response */
        $response = $this->request->send();

        $data = $response->getData();

        $this->assertTrue($response->isSuccessful());
        $this->assertNotNull($response->getList());
        $this->assertNull($response->getMessage());
        $this->assertSame('/v1/transfers/tr_164xRv2eZvKYlo2CZxJZWm1E/reversals', $data['url']);
        $this->assertFalse($response->isRedirect());
    }

    public function testSendFailure()
    {
        $this->request->setTransferReference('NOTFOUND');

        $this->setMockHttpResponse(
            [Response::fromMessage(file_get_contents(__DIR__ . '/../../Mock/Transfers/ListTransferReversalsFailure.txt'))]
        );
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('No such transfer: NOTFOUND', $response->getMessage());
    }
}
