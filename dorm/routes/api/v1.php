<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WalletController;

/**
 * @group Products
 *
 * API endpoints for managing products.
 */
Route::group(['prefix' => 'products'], function () {
    /**
     * Get all products.
     *
     * Retrieve a list of all available products.
     *
     * @response 200 {
     *   "products": [
     *     {"id": 1, "name": "Product 1", "price": "100.00"},
     *     {"id": 2, "name": "Product 2", "price": "200.00"}
     *   ]
     * }
     */
    Route::get('/', [ProductController::class, 'index']);

    /**
     * Create a new product.
     *
     * Add a new product to the database.
     *
     * @bodyParam name string required The name of the product. Example: "Laptop"
     * @bodyParam price numeric required The price of the product. Example: 1200.50
     *
     * @response 201 {
     *   "id": 1,
     *   "name": "Laptop",
     *   "price": "1200.50",
     *   "message": "Product created successfully."
     * }
     */
    Route::post('/', [ProductController::class, 'store']);

    /**
     * Get a specific product.
     *
     * Retrieve a single product by its ID.
     *
     * @urlParam id int required The ID of the product. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Laptop",
     *   "price": "1200.50"
     * }
     * @response 404 {
     *   "message": "Product not found."
     * }
     */
    Route::get('/{id}', [ProductController::class, 'show']);

    /**
     * Update an existing product.
     *
     * Modify the details of an existing product.
     *
     * @urlParam id int required The ID of the product to update. Example: 1
     * @bodyParam name string The new name of the product. Example: "Updated Laptop"
     * @bodyParam price numeric The new price of the product. Example: 1300.00
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Updated Laptop",
     *   "price": "1300.00",
     *   "message": "Product updated successfully."
     * }
     */
    Route::put('/{id}', [ProductController::class, 'update']);

    /**
     * Delete a product.
     *
     * Remove a product from the database.
     *
     * @urlParam id int required The ID of the product to delete. Example: 1
     *
     * @response 204 {
     *   "message": "Product deleted successfully."
     * }
     */
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

/**
 * @group Orders
 *
 * API endpoints for managing orders.
 */
Route::group(['prefix' => 'orders'], function () {
    /**
     * Get all orders.
     *
     * Retrieve a list of all available orders.
     *
     * @response 200 {
     *   "orders": [
     *     {"id": 1, "user_id": 1, "total": "150.00"},
     *     {"id": 2, "user_id": 2, "total": "200.00"}
     *   ]
     * }
     */
    Route::get('/', [OrderController::class, 'index']);

    /**
     * Create a new order.
     *
     * Place a new order in the system.
     *
     * @bodyParam user_id int required The ID of the user placing the order. Example: 1
     * @bodyParam total numeric required The total price of the order. Example: 150.00
     *
     * @response 201 {
     *   "id": 1,
     *   "user_id": 1,
     *   "total": "150.00",
     *   "message": "Order created successfully."
     * }
     */
    Route::post('/', [OrderController::class, 'store']);

    /**
     * Get a specific order.
     *
     * Retrieve a single order by its ID.
     *
     * @urlParam id int required The ID of the order. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "user_id": 1,
     *   "total": "150.00"
     * }
     * @response 404 {
     *   "message": "Order not found."
     * }
     */
    Route::get('/{id}', [OrderController::class, 'show']);

    /**
     * Update an existing order.
     *
     * Modify the details of an existing order.
     *
     * @urlParam id int required The ID of the order to update. Example: 1
     * @bodyParam total numeric required The new total price of the order. Example: 200.00
     *
     * @response 200 {
     *   "id": 1,
     *   "user_id": 1,
     *   "total": "200.00",
     *   "message": "Order updated successfully."
     * }
     */
    Route::put('/{id}', [OrderController::class, 'update']);

    /**
     * Delete an order.
     *
     * Remove an order from the system.
     *
     * @urlParam id int required The ID of the order to delete. Example: 1
     *
     * @response 204 {
     *   "message": "Order deleted successfully."
     * }
     */
    Route::delete('/{id}', [OrderController::class, 'destroy']);
});

/**
 * @group Wallet
 *
 * API endpoints for managing wallets.
 */
Route::group(['prefix' => 'wallet'], function () {
    /**
     * Get wallet balance.
     *
     * Retrieve the balance of a user's wallet.
     *
     * @urlParam userId int required The ID of the user whose wallet balance is being retrieved. Example: 1
     *
     * @response 200 {
     *   "balance": "1000.00"
     * }
     */
    Route::get('/balance/{userId}', [WalletController::class, 'balance']);

    /**
     * Fund wallet.
     *
     * Add funds to a user's wallet.
     *
     * @bodyParam user_id int required The ID of the user. Example: 1
     * @bodyParam amount numeric required The amount to add to the wallet. Example: 500.00
     *
     * @response 200 {
     *   "message": "Wallet funded successfully."
     * }
     */
    Route::post('/fund', [WalletController::class, 'fund']);

    /**
     * Get wallet transactions.
     *
     * Retrieve a list of transactions for a user's wallet.
     *
     * @urlParam userId int required The ID of the user whose transactions are being retrieved. Example: 1
     *
     * @response 200 {
     *   "transactions": [
     *     {"id": 1, "amount": "500.00", "type": "credit"},
     *     {"id": 2, "amount": "200.00", "type": "debit"}
     *   ]
     * }
     */
    Route::get('/transactions/{userId}', [WalletController::class, 'transactions']);
});
