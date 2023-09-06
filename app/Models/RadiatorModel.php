<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RadiatorModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'length',
        'height',
        'type',
        'price',
        'radiator_id'
    ];

    /**
     * @return BelongsTo
     */
    public function radiator(): BelongsTo
    {
        return $this->belongsTo(Radiator::class);
    }
}
