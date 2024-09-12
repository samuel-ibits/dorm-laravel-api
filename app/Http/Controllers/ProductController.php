<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @group Products
 *
 * API endpoints for managing products.
 */
class ProductController extends Controller
{
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }

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
     * @response 422 {
     *   "message": "Validation failed.",
     *   "errors": {
     *     "name": ["The name field is required."],
     *     "price": ["The price must be a valid number."]
     *   }
     * }
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        $product = Product::create($request->only(['name', 'price']));

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'message' => 'Product created successfully.'
        ], 201);
    }

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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        return response()->json($product);
    }

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
     * @response 404 {
     *   "message": "Product not found."
     * }
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric'
        ]);

        $product->update($request->only(['name', 'price']));

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'message' => 'Product updated successfully.'
        ]);
    }

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
     * @response 404 {
     *   "message": "Product not found."
     * }
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully.'], 204);
    }
}
