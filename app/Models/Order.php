<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'boiler_id',
        'installation_date',
        'status',
        'boiler_price',
        'payment_intend',
        'token',
    ];

    /**
     * @return HasOne
     */
    public function orderAddress(): HasOne
    {
        return $this->hasOne(OrderAddress::class);
    }

    /**
     * @return BelongsTo
     */
    public function boiler(): BelongsTo
    {
        return $this->belongsTo(Boiler::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot(['product_price']);
    }
}
