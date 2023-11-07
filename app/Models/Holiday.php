<?php

namespace App\Models;

use App\Traits\CreatedUpdatedDeletedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use CreatedUpdatedDeletedBy, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'from_date',
        'to_date',
        'note',
        'created_by',
        'updated_by',
    ];

    public function centers(): BelongsToMany
    {
        return $this->belongsToMany(Center::class);
    }
}
