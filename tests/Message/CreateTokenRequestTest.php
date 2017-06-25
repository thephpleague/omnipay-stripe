<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 18/06/17
 * Time: 21:30
 */

namespace Omnipay\Stripe\Message;


use Omnipay\Tests\TestCase;

class CreateTokenRequestTest extends TestCase
{
    /**
     * @var CreateTokenRequest $request
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new CreateTokenRequest($this->getHttpClient(), $this->getHttpRequest());

        $this->request->setCustomer('cus_example123');
        $this->request->setConnectedStripeAccountHeader('acct_12oh2oi3');
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/tokens', $this->request->getEndpoint());
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     * @expectedExceptionMessage You must pass either the card or the customer
     */
    public function testGetDataInvalid()
    {
        $this->request->setCustomer(null);
        $this->request->setCard(null);

        $this->request->getData();
    }

    public function getDataWithCard()
    {
        $card = $this->getValidCard();
        $this->request->setCard($card);

        $data = $this->request->getData();

        $this->assertSame($card['number'], $data['card']['number']);
    }

    public function testResponseFailure()
    {
        $this->setMockHttpResponse('CreateTokenFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());

        $this->assertNull($response->getTransactionReference());
    }

    public function testResponseSuccess()
    {
        $this->setMockHttpResponse('CreateTokenSuccess.txt');
        $response = $this->request->send();

        $data = $response->getData();
        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('tok_1AWDl1JqXiFraDuL2xOKEXKy', $data['id']);
        $this->assertSame('token', $data['object']);
    }


}
