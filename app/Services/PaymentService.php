<?php

namespace App\Services;


use YooKassa\Client;

class PaymentService
{
    public function index()
    {

    }

    public function getClient()
    {
        $client = new Client();
        $client->setAuth('918753', 'test_z-royLnN7vlD7XXOO1CblsIkUK-uUc2yc_EJSs_sx-M');

        return $client;
    }

    /**
     * @throws \YooKassa\Common\Exceptions\NotFoundException
     * @throws \YooKassa\Common\Exceptions\ResponseProcessingException
     * @throws \YooKassa\Common\Exceptions\ApiException
     * @throws \YooKassa\Common\Exceptions\BadApiRequestException
     * @throws \YooKassa\Common\Exceptions\ExtensionNotFoundException
     * @throws \YooKassa\Common\Exceptions\InternalServerError
     * @throws \YooKassa\Common\Exceptions\ForbiddenException
     * @throws \YooKassa\Common\Exceptions\TooManyRequestsException
     * @throws \YooKassa\Common\Exceptions\UnauthorizedException
     */
    public function createPayment(float $amount, string $description, array $options = [])
    {
        $client = $this->getClient();
        $payment = $client->createPayment([
            'amount' => [
                'value' => $amount,
                'currency' => 'RUB'
            ],
            'capture' => true,
            'confirmation' => array(
                'type' => 'redirect',
                'return_url' => route('home'),
            ),
            'metadata' => [
                'transaction_id' => $options['transaction_id'],
            ],
            'description' => $description
        ], uniqid('',true));

        return $payment->getConfirmation()->getConfirmationUrl();
    }
}
