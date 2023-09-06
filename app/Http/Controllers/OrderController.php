<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Services\PaymentService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService   $orderService,
        private readonly PaymentService $paymentService,
    ){ }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function applyOrder(OrderRequest $request): JsonResponse
    {
        try
        {
            DB::transaction(function () use ($request): void
            {
                $order = $this->orderService->storeOrder($request->validated());

                if ($order->id)
                {
                    $this->orderService->storeOrderAddress($order, $request['installation_address']);
                    $this->orderService->storeOrderProduct($order, $request->validated());

                    $paymentIntent = $this->paymentService->createPaymentIntent($request->validated());

                    $this->orderService->updateOrderPaymentIntendAndStatus($paymentIntent, $paymentIntent->status, $order);
                }
            });

            return response()->json(['message' => 'Success']);
        }
        catch (Exception $exception)
        {
            return response()->json($exception->getMessage());
        }
    }
}
