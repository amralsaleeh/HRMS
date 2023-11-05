<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;


    protected $fillable = ['name','from_date','to_date','note','created_by','updated_by'];
}
