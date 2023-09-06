<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boilerService extends Model
{
    protected $fillable = [
        'boiler_id',
        'service_id',
        'is_free',
    ];
    use HasFactory;
}
