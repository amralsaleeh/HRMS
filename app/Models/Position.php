<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'vacancies_count', 'created_by', 'updated_by'];

    public function timeline()
    {
        return $this->hasMany(Timeline::class);
    }
}
