<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','reason','is_sent','created_by','updated_by'];

    public function employee(){
      return $this->belongsTo(Employee::class);
    }
}
