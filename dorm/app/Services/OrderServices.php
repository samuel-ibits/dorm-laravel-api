<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function getAllOrders()
    {
        return Order::all();
    }

    public function createOrder($data)
    {
        return Order::create($data);
    }

    public function getOrderById($id)
    {
        return Order::findOrFail($id);
    }

    public function updateOrder($data, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($data);
        return $order;
    }

    public function deleteOrder($id)
    {
        return Order::destroy($id);
    }
}
