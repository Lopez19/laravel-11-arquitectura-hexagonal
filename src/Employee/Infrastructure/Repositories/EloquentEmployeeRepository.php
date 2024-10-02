<?php

declare(strict_types=1);

namespace Src\Employee\Infrastructure\Repositories;

use App\Employee\Domain\ValueObjects\EmployeeId;
use App\Employee\Domain\ValueObjects\Hours;
use App\Models\Employee;
use Src\Employee\Domain\Contracts\EmployeeRepository;
use Src\Employee\Domain\Entities\EmployeeEntity;

final class EloquentEmployeeRepository implements EmployeeRepository
{

    /**
     * @var Employee
     */
    private $model;

    public function __construct()
    {
        $this->model = new Employee();
    }

    public function search(EmployeeId $employeeId): ?EmployeeEntity
    {
        $employee = $this->model->findOrFail($employeeId->getId());

        return new EmployeeEntity(
            new EmployeeId($employee->id),
            new Hours($employee->hoursWorked),
        );
    }
}
