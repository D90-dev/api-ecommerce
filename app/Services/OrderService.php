<?php

namespace App\Services;

use App\Models\Boiler;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\orderProduct;
use App\Models\Product;
use Str;
use Stripe\PaymentIntent;

class OrderService
{
    /**
     * @param array $data
     * @return Order
     */
    public function storeOrder(array $data): Order
    {
        $boiler = Boiler::query()->where('id', $data['boilerId'])->first();

        return Order::query()->create([
            'installation_date' => $data['installation_date'] ?? null,
            'boiler_price' => $boiler->price,
            'boiler_id' => $boiler->id,
            'token' => Str::random(30),
        ]);
    }

    /**
     * @param Order $order
     * @param array $data
     * @return OrderAddress
     */
    public function storeOrderAddress(Order $order, array $data): OrderAddress
    {
        return OrderAddress::query()->create([
            'order_id' => $order->id,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'first_name' =>$data['first_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'address1' => $data['address1'] ?? null,
            'address2' => $data['address2'] ?? null,
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'zip_code' => $data['zip_code'] ?? null,
        ]);
    }

    /**
     * @param Order $order
     * @param array $data
     * @return void
     */
    public function storeOrderProduct(Order $order, array $data): void
    {
        foreach ($data['products'] as $productFromRequest)
        {
            $product = Product::query()->where('id', $productFromRequest['id'])->first();

            orderProduct::query()->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_price' => $product->price,
                'count' => $productFromRequest['count'],
            ]);
        }
    }

    /**
     * @param string $status
     * @param Order $order
     * @return int
     */
    public function updateOrderStatus(string $status, Order $order): int
    {
        return $order->update([
            'status' => $status,
        ]);
    }

    /**
     * @param PaymentIntent $paymentIntent
     * @param string $status
     * @param Order $order
     * @return int
     */
    public function updateOrderPaymentIntendAndStatus(PaymentIntent $paymentIntent, string $status, Order $order): int
    {
        return $order->update([
            'payment_intend' => $paymentIntent->client_secret,
            'status' => $status,
        ]);
    }
}
