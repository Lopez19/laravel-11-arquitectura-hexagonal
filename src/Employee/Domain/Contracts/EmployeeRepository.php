<?php

namespace Src\Employee\Domain\Contracts;

use App\Employee\Domain\ValueObjects\EmployeeId;
use Src\Employee\Domain\Entities\EmployeeEntity;

interface EmployeeRepository
{
    public function search(EmployeeId $employeeId): ?EmployeeEntity;
    public function save(EmployeeEntity $employeeEntity): void;
}
