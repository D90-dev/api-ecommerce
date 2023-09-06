<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\JoinClause;

class ProductService
{
    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllProductsPaginated(int $perPage = 4): LengthAwarePaginator
    {
        return Product::query()
            ->with('file')
            ->where('type', '<>', 'controller')
            ->paginate($perPage);
    }

    /**
     * @param int $perPage
     * @param int $boilerId
     * @return LengthAwarePaginator
     */
    public function getControllersPaginated(int $boilerId, int $perPage = 4): LengthAwarePaginator
    {
        return Product::query()
            ->with('file')
            ->where('type', 'controller')
            ->leftJoin('boiler_products', function (JoinClause $join) use($boilerId) {
                $join->on('products.id', '=', 'boiler_products.product_id')
                    ->where('boiler_products.is_free', 1);
            })
            ->where('boiler_products.boiler_id', $boilerId)
            ->select('products.*', 'boiler_products.is_free', 'boiler_products.boiler_id')
            ->groupBy('products.id', 'boiler_products.is_free', 'boiler_products.boiler_id')
            ->paginate($perPage);
    }
}
