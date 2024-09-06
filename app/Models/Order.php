<?php

namespace App\Models;

use EightyNine\Approvals\Models\ApprovableModel;
use EightyNine\Approvals\Traits\Approvable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends ApprovableModel
{


    use HasFactory,Approvable;
    public bool $autoSubmit = true;

    public function employee(): BelongsTo {
        return $this->belongsTo(Employee::class);
    }

    public function vehicle(): BelongsTo {
        return $this->belongsTo(Vehicle::class);
    }
    public function driver(): BelongsTo {
        return $this->belongsTo(Driver::class);
    }
}
