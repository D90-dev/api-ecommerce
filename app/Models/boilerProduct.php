<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boilerProduct extends Model
{
    protected $fillable = [
        'boiler_id',
        'product_id',
        'is_free',
    ];
    use HasFactory;
}
