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
use Illuminate\Support\Facades\Auth;

class Center extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = ['name', 'start_work_hour', 'end_work_hour', 'weekends'];

    // 👉 Links
    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    public function holidays(): BelongsToMany
    {
        return $this->belongsToMany(Holiday::class);
    }

    // 👉 Attributes
    protected function name(): Attribute
    {
        return Attribute::make(set: fn (string $value) => ucfirst($value));
    }

    protected function startWorkHour(): Attribute
    {
        return Attribute::make(get: fn (string $value) => Carbon::parse($value)->format('H:i'));
    }

    protected function endWorkHour(): Attribute
    {
        return Attribute::make(get: fn (string $value) => Carbon::parse($value)->format('H:i'));
    }

    protected function weekends(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => explode(',', $value),
            set: fn (array $value) => implode(',', $value)
        );
    }

    // 👉 Functions
    public function activeEmployees()
    {
        if (
            in_array(
                User::find(Auth::id())
                    ?->getRoleNames()
                    ->first(),
                ['Admin', 'HR', 'CR-S']
            )
        ) {
            $activeEmployees = Timeline::whereNull('end_date')
                ->join('employees', 'timelines.employee_id', '=', 'employees.id')
                ->where('employees.is_active', 1)
                ->orderBy('employees.first_name', 'asc')
                ->with('employee')
                ->get();
        } else {
            $centerEmployees = $this->timelines()
                ->whereNull('end_date')
                ->join('employees', 'timelines.employee_id', '=', 'employees.id')
                ->where('employees.is_active', 1)
                ->orderBy('employees.first_name', 'asc')
                ->with('employee')
                ->get();

            $notAffiliatedEmployees = Center::find(100)
                ->timelines()
                ->whereNull('end_date')
                ->join('employees', 'timelines.employee_id', '=', 'employees.id')
                ->where('employees.is_active', 1)
                ->orderBy('employees.first_name', 'asc')
                ->with('employee')
                ->get();

            $mergedEmployees = $centerEmployees->merge($notAffiliatedEmployees);
            $mergedEmployees = $mergedEmployees->sortBy('employee.first_name');

            $activeEmployees = $mergedEmployees;
        }

        return $activeEmployees;
    }

    public function getHoliday($date)
    {
        return $this->holidays()
            ->where('from_date', '<=', $date)
            ->where('to_date', '>=', $date)
            ->first();
    }
}
