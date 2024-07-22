<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = ['name', 'from_date', 'to_date', 'note'];

    // 👉 Links
    public function centers(): BelongsToMany
    {
        return $this->belongsToMany(Center::class)->withPivot(
            'created_by',
            'updated_by',
            'deleted_by',
            'created_at',
            'updated_at',
            'deleted_at'
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(set: fn (string $value) => ucfirst($value));
    }
}
