<?php
/**
 * Stripe Create Customer Request
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Create Customer Request
 *
 * Customer objects allow you to perform recurring charges and
 * track multiple charges that are associated with the same customer.
 * The API allows you to create, delete, and update your customers.
 * You can retrieve individual customers as well as a list of all of
 * your customers.
 *
 * Example:
 *
 * <code>
 *   // Create a gateway for the Stripe Gateway
 *   // (routes to GatewayFactory::create)
 *   $gateway = Omnipay::create('Stripe');
 *
 *   // Initialise the gateway
 *   $gateway->initialize(array(
 *       'apiKey' => 'MyApiKey',
 *   ));
 *
 *   // Create a credit card object
 *   // This card can be used for testing.
 *   // The CreditCard object is also used for creating customers.
 *   $card = new CreditCard(array(
 *               'firstName'    => 'Example',
 *               'lastName'     => 'Customer',
 *               'number'       => '4242424242424242',
 *               'expiryMonth'  => '01',
 *               'expiryYear'   => '2020',
 *               'cvv'          => '123',
 *               'email'                 => 'customer@example.com',
 *               'billingAddress1'       => '1 Scrubby Creek Road',
 *               'billingCountry'        => 'AU',
 *               'billingCity'           => 'Scrubby Creek',
 *               'billingPostcode'       => '4999',
 *               'billingState'          => 'QLD',
 *   ));
 *
 *   // Do a create customer transaction on the gateway
 *   $response = $gateway->createCustomer(array(
 *       'card'                     => $card,
 *   ))->send();
 *   if ($response->isSuccessful()) {
 *       echo "Gateway createCustomer was successful.\n";
 *       // Find the customer ID
 *       $customer_id = $response->getCustomerReference();
 *       echo "Customer ID = " . $customer_id . "\n";
 *       // Find the card ID
 *       $card_id = $response->getCardReference();
 *       echo "Card ID = " . $card_id . "\n";
 *   }
 * </code>
 *
 * @link https://stripe.com/docs/api#customers
 */
class CreateCustomerRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['description'] = $this->getDescription();

        if ($this->getToken()) {
            $data['card'] = $this->getToken();
        } elseif ($this->getCard()) {
            $data['card'] = $this->getCardData();
            $data['email'] = $this->getCard()->getEmail();
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint . '/customers';
    }
}
