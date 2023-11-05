<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    protected $fillable = ['contract_id','first_name','father_name','last_name','mother_name','birth_and_place', 'national_number','mobile_number','degree','gender','address','notes','max_leave_allowed','delay_counter','hourly_counter','is_active','created_by','updated_by'];
}
