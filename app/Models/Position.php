<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'vacancies_count',
    ];

    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ucfirst($value),
        );
    }
}
