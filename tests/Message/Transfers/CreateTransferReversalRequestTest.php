<?php

namespace Omnipay\Stripe\Message\Transfers;

use Guzzle\Http\Message\Response;
use Omnipay\Tests\TestCase;

class CreateTransferReversalRequestTest extends TestCase
{
    /**
     * @var \Omnipay\Stripe\Message\Transfers\CreateTransferReversalRequest
     */
    protected $request;

    public function setUp()
    {
        $this->request = new CreateTransferReversalRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'transferReference' => 'REVERSAL_ID',
                'amount' => '12.00',
                'description' => 'Reversing Order 42',
                'metadata' => array(
                    'foo' => 'bar',
                ),
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame(1200, $data['amount']);
        $this->assertSame('Reversing Order 42', $data['description']);
        $this->assertSame(array('foo' => 'bar'), $data['metadata']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse(
            array(Response::fromMessage(file_get_contents(__DIR__.'/../../Mock/Transfers/CreateTransferReversalRequestSuccess.txt')))
        );

        /** @var \Omnipay\Stripe\Message\Response $response */
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('trr_1ARKQ22eZvKYlo2Cv5APdtKF', $response->getTransferReversalReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse(
            array(Response::fromMessage(file_get_contents(__DIR__.'/../../Mock/Transfers/FetchTransferReversalFailure.txt')))
        );
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('No such transfer reversal: trr_1ARKQ22eZvKYlo2Cv5APdtKF', $response->getMessage());
    }

}
