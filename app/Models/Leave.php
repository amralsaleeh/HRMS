<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'discount_rate',
        'notes',
        'created_by',
        'updated_by',
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
