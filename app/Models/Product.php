<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'type',
        ];
    use HasFactory;


    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * @return BelongsToMany
     */
    public function boilers(): BelongsToMany
    {
        return $this->belongsToMany(Boiler::class, 'boiler_products')
            ->withPivot('is_free')
            ->withTimestamps();
    }
}
