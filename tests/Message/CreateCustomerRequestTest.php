<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class CreateCustomerRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testEndpoint()
    {
        $this->assertSame('https://api.stripe.com/v1/customers', $this->request->getEndpoint());
    }

    public function testData()
    {
        $shipping = array('name' => 'John Doe', ['address' => ['line1' => 'Some street']]);

        $this->request->setEmail('customer@business.dom');
        $this->request->setDescription('New customer');
        $this->request->setMetadata(array('field' => 'value'));
        $this->request->setShipping($shipping);

        $data = $this->request->getData();

        $this->assertSame('customer@business.dom', $data['email']);
        $this->assertSame('New customer', $data['description']);
        $this->assertArrayHasKey('field', $data['metadata']);
        $this->assertSame('value', $data['metadata']['field']);
        $this->assertSame($shipping, $data['shipping']);
    }

    public function testDataWithToken()
    {
        $this->request->setToken('xyz');
        $data = $this->request->getData();

        $this->assertSame('xyz', $data['card']);
        $this->assertFalse(isset($data['email']));
    }

    public function testDataWithTokenAndEmail()
    {
        $this->request->setToken('xyz');
        $this->request->setEmail('xyz@test.com');
        $data = $this->request->getData();

        $this->assertSame('xyz', $data['card']);
        $this->assertSame('xyz@test.com', $data['email']);
    }

    public function testDataWithCard()
    {
        $card = $this->getValidCard();
        $this->request->setCard($card);
        $data = $this->request->getData();

        $this->assertSame($card['number'], $data['card']['number']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('CreateCustomerSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertSame('cus_1MZSEtqSghKx99', $response->getCustomerReference());
        $this->assertSame('card_15WhVwIobxWFFmzdQ3QBSwNi', $response->getCardReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('CreateCustomerFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getCardReference());
        $this->assertSame('You must provide an integer value for \'exp_year\'.', $response->getMessage());
    }
}
