<?php

declare(strict_types=1);

namespace Src\Employee\Infrastructure\Repositories;

use App\Employee\Domain\ValueObjects\EmployeeId;
use Src\Employee\Domain\Contracts\EmployeeRepository;
use Src\Employee\Domain\Entities\EmployeeEntity;

final class InFileEmployeeRepository implements EmployeeRepository
{

    public function search(EmployeeId $employeeId): ?EmployeeEntity
    {
        return null;
    }

    public function save(EmployeeEntity $employeeEntity): void
    {
        if (($fp = fopen('employees.csv', 'w')) !== false) {
            foreach ($employeeEntity->toArray() as $fields) {
                fputcsv($fp, $fields);
            }
        }
        fclose($fp);
    }
}
