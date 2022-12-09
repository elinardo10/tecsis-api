<?php

namespace App\V1\Product\Controllers;

use App\Http\Controllers\Controller;
use App\V1\Product\Models\Product;
use App\V1\Product\Requests\ProductIndexRequest;
use App\V1\Product\Requests\ProductStoreRequest;
use App\V1\Product\Requests\ProductUpdateRequest;
use App\V1\Product\Resources\ProductResource;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request)
    {
        $products = Product::all();

        if (!empty($filter['keyword'])) {
            $products->where(function ($query) use ($filter) {
                $query->where('name', 'LIKE', '%' . $filter['keyword'] . '%');
            });
        }

        return ProductResource::collection($products);
    }
    public function store(ProductStoreRequest $request)
    {
        $input = $request->validated();
        $product = Product::create($input);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Product $product, ProductUpdateRequest $request)
    {
        $input = $request->validated();

        $product->fill($input);
        $product->save();

        return new ProductResource($product);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
