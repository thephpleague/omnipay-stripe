<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Common\ItemBag;
use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp()
    {
        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'amount' => '12.00',
                'currency' => 'USD',
                'card' => $this->getValidCard(),
                'description' => 'Order #42',
                'metadata' => array(
                    'foo' => 'bar',
                ),
                'applicationFee' => '1.00'
            )
        );
    }

    public function testGetData()
    {
        $data = $this->request->getData();

        $this->assertSame(1200, $data['amount']);
        $this->assertSame('usd', $data['currency']);
        $this->assertSame('Order #42', $data['description']);
        $this->assertSame('false', $data['capture']);
        $this->assertSame(array('foo' => 'bar'), $data['metadata']);
        $this->assertSame(100, $data['application_fee']);
    }

    public function testDataWithLevel3()
    {
        $this->request->setItems([
            [
                'name' => 'Cupcakes',
                'description' => 'Yummy Cupcakes',
                'price' => 4,
                'quantity' => 2,
                'taxes' => 0.4
            ],
            [
                'name' => 'Donuts',
                'description' => 'A dozen donuts',
                'price' => 1.5,
                'quantity' => 12,
                'discount' => 1.8,
                'taxes' => 0.81
            ]
        ]);
        $this->request->setTransactionId('ORD42-P1');
        $this->request->setAmount(25.41);

        $data = $this->request->getData();

        $this->assertSame('Order #42', $data['description']);
        $expectedLevel3 = [
            'merchant_reference' => 'ORD42-P1',
            'line_items' => [
                [
                    'product_code' => 'Cupcakes',
                    'product_description' => 'Yummy Cupcakes',
                    'unit_cost' => 400,
                    'quantity' => 2,
                    'tax_amount' => 40,
                ],
                [
                    'product_code' => 'Donuts',
                    'product_description' => 'A dozen donuts',
                    'unit_cost' => 150,
                    'quantity' => 12,
                    'discount_amount' => 180,
                    'tax_amount' => 81,
                ]
            ]
        ];
        $this->assertEquals($expectedLevel3, $data['level3']);
    }

    public function testDataWithInvalidLevel3()
    {
        $this->request->setItems([
            [
                'name' => 'Cupcakes',
                'description' => 'Yummy Cupcakes',
                'price' => 4,
                'quantity' => 2,
                'taxes' => 0.4
            ],
            [
                'name' => 'Donuts',
                'description' => 'A dozen donuts',
                'price' => 1.5,
                'quantity' => 12,
                'discount' => 1.8,
                'taxes' => 0.8
            ]
        ]);
        $this->request->setTransactionId('ORD42-P1');
        $this->request->setAmount(25.41);

        $data = $this->request->getData();

        $this->assertArrayNotHasKey('level3', $data,
            'should not include level 3 data if the line items do not add up to the amount');
    }

    /**
     * @expectedException \Omnipay\Common\Exception\InvalidRequestException
     * @expectedExceptionMessage The source parameter is required
     */
    public function testCardRequired()
    {
        $this->request->setCard(null);
        $this->request->getData();
    }

    public function testDataWithCustomerReference()
    {
        $this->request->setCard(null);
        $this->request->setCustomerReference('abc');
        $data = $this->request->getData();

        $this->assertSame('abc', $data['customer']);
    }

    public function testDataWithCardReference()
    {
        $this->request->setCustomerReference('abc');
        $this->request->setCardReference('xyz');
        $data = $this->request->getData();

        $this->assertSame('abc', $data['customer']);
        $this->assertSame('xyz', $data['source']);
    }

    public function testDataWithStatementDescriptor()
    {
        $this->request->setStatementDescriptor('OMNIPAY');
        $data = $this->request->getData();

        $this->assertSame('OMNIPAY', $data['statement_descriptor']);
    }

    public function testDataWithSourceAndDestination()
    {
        $this->request->setSource('abc');
        $this->request->setDestination('xyz');
        $data = $this->request->getData();

        $this->assertSame('abc', $data['source']);
        $this->assertSame('xyz', $data['destination']);
    }

    public function testDataWithToken()
    {
        $this->request->setCustomerReference('abc');
        $this->request->setToken('xyz');
        $data = $this->request->getData();

        $this->assertSame('abc', $data['customer']);
        $this->assertSame('xyz', $data['source']);
    }

    public function testDataWithCard()
    {
        $card = $this->getValidCard();
        $this->request->setCard($card);
        $data = $this->request->getData();

        $this->assertSame($card['number'], $data['source']['number']);
    }

    public function testDataWithTracks()
    {
        $cardData = $this->getValidCard();
        $tracks = "%25B4242424242424242%5ETESTLAST%2FTESTFIRST%5E1505201425400714000000%3F";
        $cardData['tracks'] = $tracks;
        unset($cardData['cvv']);
        unset($cardData['billingPostcode']);
        $this->request->setCard(new CreditCard($cardData));
        $data = $this->request->getData();

        $this->assertSame($tracks, $data['source']['swipe_data']);
        $this->assertCount(2, $data['source'], "Swipe data should be present. All other fields are not required");

        // If there is any mismatch between the track data and the parsed data, Stripe rejects the transaction, so it's
        // best to suppress fields that is already present in the track data.
        $this->assertArrayNotHasKey('number', $data, 'Should not send card number for card present charge');
        $this->assertArrayNotHasKey('exp_month', $data, 'Should not send expiry month for card present charge');
        $this->assertArrayNotHasKey('exp_year', $data, 'Should not send expiry year for card present charge');
        $this->assertArrayNotHasKey('name', $data, 'Should not send name for card present charge');

        // Billing address is not accepted for card present transactions.
        $this->assertArrayNotHasKey('address_line1', $data, 'Should not send billing address for card present charge');
        $this->assertArrayNotHasKey('address_line2', $data, 'Should not send billing address for card present charge');
        $this->assertArrayNotHasKey('address_city', $data, 'Should not send billing address for card present charge');
        $this->assertArrayNotHasKey('address_state', $data, 'Should not send billing address for card present charge');

    }

    public function testDataWithTracksAndZipCVVManuallyEntered()
    {
        $cardData = $this->getValidCard();
        $tracks = "%25B4242424242424242%5ETESTLAST%2FTESTFIRST%5E1505201425400714000000%3F";
        $cardData['tracks'] = $tracks;
        $this->request->setCard(new CreditCard($cardData));
        $data = $this->request->getData();

        $this->assertSame($tracks, $data['source']['swipe_data']);
        $this->assertSame($cardData['cvv'], $data['source']['cvc']);
        $this->assertSame($cardData['billingPostcode'], $data['source']['address_zip']);
        $this->assertCount(4, $data['source'], "Swipe data, cvv and zip code should be present");
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('ch_1IU9gcUiNASROd', $response->getTransactionReference());
        $this->assertSame('card_16n3EU2baUhq7QENSrstkoN0', $response->getCardReference());
        $this->assertSame('req_8PDHeZazN2LwML', $response->getRequestId());
        $this->assertNull($response->getMessage());
    }

    public function testSendError()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('ch_1IUAZQWFYrPooM', $response->getTransactionReference());
        $this->assertNull($response->getCardReference());
        $this->assertSame('Your card was declined', $response->getMessage());
    }

    public function testSetItems()
    {
        $items = new ItemBag([
            [
                'amount' => '120.00',
                'currency' => 'USD',
                'card' => $this->getValidCard(),
                'description' => 'Order #42',
                'metadata' => [
                    'foo' => 'bar',
                ],
                'applicationFee' => '2.00'
            ]
        ]);

        $this->request->setItems($items);
        $this->assertEquals($items, $this->request->getItems());
    }
}
