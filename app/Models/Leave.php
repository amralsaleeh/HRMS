<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'discount_rate', 'notes', 'created_by', 'updated_by'];

    public function employee()
    {
        return $this->belongsToMany(Employee::class);
    }
}
