<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderQuoteRequest;
use App\Mail\OrderQuoteMail;
use App\Models\Order;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderQuoteController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
    ){ }

    /**
     * @param OrderQuoteRequest $request
     * @return JsonResponse
     */
    public function applyOrderQuote(OrderQuoteRequest $request): JsonResponse
    {
        try
        {
            DB::transaction(function () use ($request): void
            {
                $order = $this->orderService->storeOrder($request->validated());

                $order = Order::query()->with(['orderAddress', 'boiler', 'products'])->find($order->id);

                if ($order->id)
                {
                    $this->orderService->storeOrderAddress($order, $request->validated());

                    if($request->input('products'))
                        $this->orderService->storeOrderProduct($order, $request->validated());

                    $this->orderService->updateOrderStatus('quoted', $order);
                }

                Mail::to($request->input('email'))->queue(new OrderQuoteMail($request->input('email'), $request->input('phone'), $order));
            });

            return response()->json(['message' => 'Success']);
        }
        catch (Exception $exception)
        {
            return response()->json($exception->getMessage());
        }
    }
}
