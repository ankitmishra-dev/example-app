<?php
namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Services\Products\ProductSyncService;
use Illuminate\Support\Facades\Http;

class ProductSyncController extends Controller
{
    public function __invoke(ProductSyncService $productSyncService)
    {
        return $productSyncService->syncProducts();

    }
}
