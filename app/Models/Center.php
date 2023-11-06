<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use CreatedUpdatedBy, HasFactory ,SoftDeletes;

    protected $fillable = [
        'name',
        'start_work_hour',
        'end_work_hour',
        'weekends',
        'created_by',
        'updated_by',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ucfirst($value),
        );
    }

    protected function startWorkHour(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('H:i'),
        );
    }

    protected function endWorkHour(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('H:i'),
        );
    }

    protected function weekends(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => explode(',', $value),
            set: fn (array $value) => implode(',', $value),
        );
    }
}
