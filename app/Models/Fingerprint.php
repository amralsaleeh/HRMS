<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fingerprint extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','date','log','check_in','check_out','is_checked', 'created_by','updated_by'];

    public function employee(){
      return $this->belongsTo(Employee::class);
    }

}
