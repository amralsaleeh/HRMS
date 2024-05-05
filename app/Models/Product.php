<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'old_id',
        'serial_number',
        'status',
        'description',
        'in_service',
        'real_price',
        'expected_price',
        'acquisition_date',
        'acquisition_type',
        'funded_by',
        'note',
    ];
}
