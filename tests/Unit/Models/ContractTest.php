<?php

namespace Tests\Unit\Models;

use App\Models\Contract;
use App\Models\Employee;
use Tests\TestCase;

class ContractTest extends TestCase
{

    public function test_employees_relationship(): void
    {
        $contract = Contract::factory()->create();

        $this->assertInstanceOf(Employee::class, $contract->employees()->getRelated());
        $this->assertSame('contract_id', $contract->employees()->getForeignKeyName());
    }
}
