<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fingerprint extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'date',
        'log',
        'check_in',
        'check_out',
        'is_checked',
        'created_by',
        'updated_by',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
