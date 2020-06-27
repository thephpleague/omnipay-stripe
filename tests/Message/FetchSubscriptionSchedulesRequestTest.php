<?php

namespace Omnipay\Stripe\Message;

use Omnipay\Tests\TestCase;

class FetchSubscriptionSchedulesRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new FetchSubscriptionSchedulesRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setSubscriptionSchedulesReference('sub_sched_1GagVZKscivsTrcFhfMufnWP');
    }

    public function testEndpoint()
    {
        $endpoint = 'https://api.stripe.com/v1/subscription_schedules/sub_sched_1GagVZKscivsTrcFhfMufnWP';
        $this->assertSame($endpoint, $this->request->getEndpoint());
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('FetchSubscriptionSchedulesSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('sub_sched_1GagVZKscivsTrcFhfMufnWP', $response->getSubscriptionSchedulesReference());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('FetchSubscriptionSchedulesFailure.txt');
        $response = $this->request->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getSubscriptionReference());
        $message = 'No such subscription schedule: sub_sched_1GagVZKscivsTrcFhfMufnWP';
        $this->assertSame($message, $response->getMessage());
    }
}
