<?php

namespace App\Http\Controllers;

use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
    ) { }

    public function index(): ProductCollection
    {
        $products = $this->productService->getAllProductsPaginated();

        return new ProductCollection($products);
    }

    /**
     * @param Request $request
     * @return ProductCollection
     */
    public function getControllers(Request $request): ProductCollection
    {
        $boilerId = $request->query('boilerId');

        $products = $this->productService->getControllersPaginated($boilerId);

        return new ProductCollection($products);
    }
}
