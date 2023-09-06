<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Radiator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected $with = ['file'];

    /**
     * @return MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * @return HasMany
     */
    public function radiatorModels(): HasMany
    {
        return $this->hasMany(RadiatorModel::class);
    }
}
