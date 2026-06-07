<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class EnquiryBasketController extends Controller
{
    /**
     * Get all items in the enquiry basket.
     */
    public function index(Request $request)
    {
        $basket = session('enquiry_basket', []);
        $productIds = array_keys($basket);
        $products = Product::whereIn('id', $productIds)->get();

        $items = [];
        foreach ($products as $product) {
            $items[] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'thumbnail' => $product->thumbnail,
                'qty' => $basket[$product->id]['qty'] ?? 1,
            ];
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'items' => $items,
                'count' => count($items),
                'total' => collect($items)->sum(fn($i) => $i['price'] * $i['qty']),
            ]);
        }

        return view('frontend.pages.enquiry-basket', compact('items'));
    }

    /**
     * Add a product to the enquiry basket.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'integer|min:1',
        ]);

        $basket = session('enquiry_basket', []);
        $productId = $request->product_id;
        $qty = $request->qty ?? 1;

        if (isset($basket[$productId])) {
            $basket[$productId]['qty'] += $qty;
        } else {
            $basket[$productId] = ['qty' => $qty];
        }

        session(['enquiry_basket' => $basket]);

        $product = Product::find($productId);
        $totalCount = array_sum(array_column($basket, 'qty'));

        return response()->json([
            'success' => true,
            'message' => "{$product->name} added to enquiry basket",
            'count' => count($basket),
            'totalQty' => $totalCount,
            'item' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $basket[$productId]['qty'],
            ],
        ]);
    }

    /**
     * Update quantity of a basket item.
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $basket = session('enquiry_basket', []);
        $productId = $request->product_id;

        if (isset($basket[$productId])) {
            $basket[$productId]['qty'] = $request->qty;
            session(['enquiry_basket' => $basket]);
        }

        // Recalculate total
        $productIds = array_keys($basket);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
        $total = 0;
        foreach ($basket as $pid => $data) {
            if (isset($products[$pid])) {
                $total += $products[$pid]->price * $data['qty'];
            }
        }

        return response()->json([
            'success' => true,
            'count' => count($basket),
            'total' => $total,
        ]);
    }

    /**
     * Remove a product from the enquiry basket.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $basket = session('enquiry_basket', []);
        unset($basket[$request->product_id]);
        session(['enquiry_basket' => $basket]);

        return response()->json([
            'success' => true,
            'count' => count($basket),
            'message' => 'Item removed from basket',
        ]);
    }

    /**
     * Get basket count for header badge.
     */
    public function count()
    {
        $basket = session('enquiry_basket', []);
        return response()->json([
            'count' => count($basket),
            'totalQty' => array_sum(array_column($basket, 'qty')),
        ]);
    }
}
