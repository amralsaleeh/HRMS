<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Holiday extends Model
{
    use HasFactory;

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
