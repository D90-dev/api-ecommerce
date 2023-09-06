<?php

namespace App\Services;

use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentService
{
    /**
     * @param array $data
     * @return PaymentIntent
     * @throws ApiErrorException
     */
    public function createPaymentIntent(array $data): PaymentIntent
    {
        $stripeSecret = env('STRIPE_SECRET');

        Stripe::setApiKey($stripeSecret);

        return PaymentIntent::create([
            'amount' => intval($data['amount'] * 100),
            'currency' => config('order.currency'),
            'payment_method' => $data['payment_method_id'],
            'confirm' => true,
        ]);
    }
}
