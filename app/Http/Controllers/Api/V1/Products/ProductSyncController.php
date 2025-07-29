<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use App\Services\Products\ProductSyncService;

class ProductSyncController extends Controller
{
    public function __invoke(ProductSyncService $productSyncService)
    {
        return $productSyncService->syncProducts();

    }
}
