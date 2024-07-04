<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'contract_id',
        'first_name',
        'father_name',
        'last_name',
        'mother_name',
        'birth_and_place',
        'national_number',
        'mobile_number',
        'degree',
        'gender',
        'address',
        'notes',
        'max_leave_allowed',
        'delay_counter',
        'hourly_counter',
        'is_active',
        'profile_photo_path',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function fingerprints(): HasMany
    {
        return $this->hasMany(Fingerprint::class);
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }

    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    public function leaves(): BelongsToMany
    {
        return $this->belongsToMany(Leave::class)->withPivot(
            'id',
            'from_date',
            'to_date',
            'start_at',
            'end_at',
            'note',
            'is_authorized',
            'is_checked',
            'created_by',
            'updated_by',
            'deleted_by',
            'created_at',
            'updated_at',
            'deleted_at'
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    protected function hourlyCounter(): Attribute
    {
        return Attribute::make(get: fn (?string $value) => $value !== null ? Carbon::parse($value)->format('H:i') : '');
    }

    protected function delayCounter(): Attribute
    {
        return Attribute::make(get: fn (?string $value) => $value !== null ? Carbon::parse($value)->format('H:i') : '');
    }

    // Computed Attribute - Start
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->father_name.' '.$this->last_name;
    }

    public function getShortNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
    // Computed Attribute - End

    // Functions - Start
    public function getWorkedYearsAttribute()
    {
        $data = Timeline::where('employee_id', $this->id)
            ->where('is_sequent', 1)
            ->latest()
            ->value('start_date');

        return Carbon::now()->diffInYears(Carbon::parse($data)) + 1; // The reason for " + 1 " is to calculate the started year too.
    }

    public function getCurrentPositionAttribute()
    {
        $data = Timeline::with('position')
            ->where('employee_id', $this->id)
            ->whereNull('end_date')
            ->first();
        if ($data) {
            return $data->position->name;
        } else {
            return 'N/A';
        }
    }

    public function getCurrentDepartmentAttribute()
    {
        $data = Timeline::with('department')
            ->where('employee_id', $this->id)
            ->whereNull('end_date')
            ->first();
        if ($data) {
            return $data->department->name;
        } else {
            return 'N/A';
        }
    }

    public function getCurrentCenterAttribute()
    {
        $data = Timeline::with('center')
            ->where('employee_id', $this->id)
            ->whereNull('end_date')
            ->first();
        if ($data) {
            return $data->center->name;
        } else {
            return 'N/A';
        }
    }

    public function getJoinAtAttribute()
    {
        $data = Timeline::where('employee_id', $this->id)->first();
        if ($data) {
            return __('Joined').' '.Carbon::parse($data->start_date)->diffForHumans();
        } else {
            return 'N/A';
        }
    }

    public function getEmployeePhoto()
    {
        $defaultPhotoName = 'profile-photos/.default-photo.jpg';
        $user = User::where('employee_id', $this->id)->first();

        if ($user) {
            return 'storage/'.$user->profile_photo_path;
        }

        return 'storage/'.$defaultPhotoName;
    }
    // Functions - End

    // Scope - Start
    public function scopeCheckLeave(
        Builder $query,
        $employee_id,
        $leave_id,
        $from_date,
        $to_date,
        $start_at,
        $end_at
    ): void {
        $query->whereHas('leaves', function ($query) use (
            $employee_id,
            $leave_id,
            $from_date,
            $to_date,
            $start_at,
            $end_at
        ) {
            $query
                ->where('employee_id', $employee_id)
                ->where('leave_id', $leave_id)
                ->where('from_date', $from_date)
                ->where('to_date', $to_date)
                ->where('start_at', $start_at)
                ->where('end_at', $end_at);
        });
    }
    // Scope - End
}
