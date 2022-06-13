<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;
use YooKassa\Model\NotificationEventType;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    /**
     * @param PaymentService $service
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \YooKassa\Common\Exceptions\ApiException
     * @throws \YooKassa\Common\Exceptions\BadApiRequestException
     * @throws \YooKassa\Common\Exceptions\ExtensionNotFoundException
     * @throws \YooKassa\Common\Exceptions\ForbiddenException
     * @throws \YooKassa\Common\Exceptions\InternalServerError
     * @throws \YooKassa\Common\Exceptions\NotFoundException
     * @throws \YooKassa\Common\Exceptions\ResponseProcessingException
     * @throws \YooKassa\Common\Exceptions\TooManyRequestsException
     * @throws \YooKassa\Common\Exceptions\UnauthorizedException
     */
    public function create(PaymentService $service, Request $request)
    {
        $amount = (float)$request->input('amount');
        $description = "Пополнение баланса";
        $transaction = Transactions::create([
            'amount' => $amount,
            'description' => $description
        ]);

        if ($transaction) {
            $link = $service->createPayment($amount, $description, [
                'transaction_id' => $transaction->id
            ]);
            return redirect()->away($link);
        }
    }

    public function callback(Request $request, PaymentService $service)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);

        $payment = $notification->getObject();
        if(isset($payment->status) && $payment->status == 'waiting_for_capture'){
            $service->getClient()->capturePayment([
                'amount' => $payment->amount
            ],$payment->id,uniqid('',true));
        }

        if (isset($payment->status) && $payment->status == 'succeeded') {
            if ((bool)$payment->paid === true) {
                $metadata = (object)$payment->metadata;
                if (isset($metadata->transaction_id)) {
                    $transactionId = (int)$metadata->transaction_id;
                    $transaction = Transactions::find($transactionId);
                    $transaction->status = 'CONFIRMED';
                    $transaction->save();

                    if(cache()->has('amount')) {
                        cache()->forever('balance',(float)cache()->get('balance')+(float)$payment->amount->value);
                    }else{
                        cache()->forever('balance', (float)$payment->amount->value);
                    }
                }
            }
        }
    }
}
