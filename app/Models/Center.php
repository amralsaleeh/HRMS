<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'start_work_hour',
        'end_work_hour',
        'weekends',
    ];

    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    public function holidays(): BelongsToMany
    {
        return $this->belongsToMany(Holiday::class);
    }

    public function activeEmployees()
    {
        return $this->timelines()
            ->whereNull('end_date')
            ->join('employees', 'timelines.employee_id', '=', 'employees.id')
            ->orderBy('employees.first_name', 'asc')
            ->with('employee');
    }

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
