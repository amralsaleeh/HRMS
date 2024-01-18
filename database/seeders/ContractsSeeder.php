<?php

namespace Database\Seeders;

use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractsSeeder extends Seeder
{
    public function run(): void
    {
        Contract::create([
            'name' => 'Full Time (100)%',
            'work_rate' => '100',
        ]);

        Contract::create([
            'name' => 'Part Time (60)%',
            'work_rate' => '60',
        ]);
    }
}
