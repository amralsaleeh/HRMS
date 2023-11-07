<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'work_rate',
        'notes',
        'created_by',
        'updated_by',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
