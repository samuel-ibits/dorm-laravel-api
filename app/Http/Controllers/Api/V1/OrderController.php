<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return response()->json($this->orderService->getAllOrders());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return response()->json($this->orderService->createOrder($data));
    }

    public function show($id)
    {
        return response()->json($this->orderService->getOrderById($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return response()->json($this->orderService->updateOrder($data, $id));
    }

    public function destroy($id)
    {
        return response()->json($this->orderService->deleteOrder($id));
    }
}
