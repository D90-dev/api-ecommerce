<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Boiler extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'additional_info',
        'old_price',
        'radiators_count',
        'hot_water_flow_rate',
        'heating_output',
        'warranty',
        'efficiency',
        'height',
        'width',
        'depth',
        'hydrogen_blend',
        'best_seller',
    ];
    use HasFactory;

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'boiler_products')
            ->withPivot('is_free')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'boiler_services')
            ->withPivot('is_free')
            ->withTimestamps();
    }
}
