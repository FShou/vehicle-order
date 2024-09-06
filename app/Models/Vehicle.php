<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    public function vehicle_owner(): BelongsTo {
        return $this->belongsTo(VehicleOwner::class);
    }

    public function order(): HasMany {
        return $this->hasMany(Order::class);
    }
}
