<?php
/**
 * Stripe Create Credit Card Request
 */

namespace Omnipay\Stripe\Message;

/**
 * Stripe Create Credit Card Request
 *
 * In the stripe system, creating a credit card requires passing
 * a customer ID.  The card is then added to the customer's account.
 * If the customer has no default card then the newly added
 * card becomes the customer's default card.
 *
 * This call can be used to create a new customer or add a card
 * to an existing customer.  If a customerReference is passed in then
 * a card is added to an existing customer.  If there is no
 * customerReference passed in then a new customer is created.  The
 * response in that case will then contain both a customer token
 * and a card token, and is essentially the same as CreateCustomerRequest
 *
 * @see CreateCustomerRequest
 * @link https://stripe.com/docs/api#create_card
 */
class CreateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        
        // Only set the description if we are creating a new customer.
        if (! $this->getCustomerReference()) {
            $data['description'] = $this->getDescription();
        }

        // If a token is passed then use the token.
        if ($this->getToken()) {
            $data['card'] = $this->getToken();

        // If a card is passed then use the card.
        } elseif ($this->getCard()) {
            $this->getCard()->validate();
            $data['card'] = $this->getCardData();

            // Only set the email address if we are creating a new customer.
            if (! $this->getCustomerReference()) {
                $data['email'] = $this->getCard()->getEmail();
            }

        // one of token or card is required
        } else {
            $this->validate('card');
        }

        return $data;
    }

    public function getEndpoint()
    {
        if ($this->getCustomerReference()) {
            // Create a new card on an existing customer
            return $this->endpoint . '/customers/' .
                $this->getCustomerReference() . '/cards';
        }
        // Create a new customer and card
        return $this->endpoint . '/customers';
    }
}
