<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = ['center_id','department_id','position_id','employee_id','start_date','end_date','notes','created_by','updated_by'];

}
