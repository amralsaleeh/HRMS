<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['name','work_rate','notes','created_by','updated_by'];

    public function employee(){
      return $this->hasMany(Employee::class);
    }
}
