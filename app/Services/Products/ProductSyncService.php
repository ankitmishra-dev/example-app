<?php

namespace App\Services\Products;

use App\Models\Products\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductSyncService
{
    private const BIG_COMM_PRODUCT_FETCH_ENDPOINT = 'https://api.bigcommerce.com/stores/hlmlnj8tsp/v3/catalog/products';

    private const SAAS_ENDPOINT = 'https://box.saasintegrator.ai/api/products';

    public function syncProducts()
    {
        $response = Http::withoutVerifying()->asJson()->acceptJson()->withHeaders([
            'X-AUTH-TOKEN' => config('big-comm.big_comm.token'),
        ])->get(self::BIG_COMM_PRODUCT_FETCH_ENDPOINT);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch products from BigCommerce'], 500);
        }

        $products = $response->json()['data'];

        DB::beginTransaction();

        try {
            foreach ($products as $product) {

                if (Product::where('bigcomm_prod_id', $product['id'])->exists()) {
                    continue;
                }

                $newProduct = Product::create([
                    'bigcomm_prod_id' => $product['id'],
                    'name' => $product['sku'] ?? null,
                    'sku' => $product['sku'] ?? null,
                    'slug' => $product['slug'] ?? null,
                    'is_active' => $product['is_active'] ?? 0,
                    'price' => $product['price'] ?? null,
                    'description' => $product['description'] ?? null,
                    'category_id' => null, // as in the documnet it is not asked

                ]);

                $saasResponse = Http::withoutVerifying()->asJson()->acceptJson()->withToken(config('big-comm.saas.api_token'))->post(self::SAAS_ENDPOINT, [
                    'sku' => $product['sku'] ?? null,
                    'name' => $product['name'] ?? null,
                    'slug' => $product['slug'] ?? null,
                    'description' => $product['description'] ?? null,
                    'is_active' => true,
                    'price' => $product['price'] ?? null,
                    'category_id' => 0,
                ]);

                if ($saasResponse->failed()) {
                    Log::error('Saas API Failed for Product ID: '.$product['id']);
                }
            }

            DB::commit();

            return response()->json(['message' => 'Products synced successfully']);

        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Transaction failed: '.$e->getMessage());

            return response()->json(['error' => 'Sync failed. Transaction rolled back.'], 500);
        }
    }
}
