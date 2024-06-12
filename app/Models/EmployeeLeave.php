<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeLeave extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $table = 'employee_leave';

    protected $fillable = [
        'id',
        'employee_id',
        'leave_id',
        'from_date',
        'to_date',
        'start_at',
        'end_at',
        'note',
        'is_authorized',
        'is_checked',
    ];

    protected $hidden = [
        'is_authorized',
        'is_checked',
        'deleted_by',
        'deleted_at',
    ];
}
