<?php

declare(strict_types=1);

namespace Src\Employee\Domain\Entities;

use App\Employee\Domain\ValueObjects\EmployeeId;
use App\Employee\Domain\ValueObjects\Hours;

final class EmployeeEntity
{
    /**
     * @var EmployeeId
     */
    private EmployeeId $id;

    /**
     * @var Hours
     */
    private Hours $hoursWorked;

    /**
     * @var float
     */
    private float $salary;

    /**
     * @var float
     */
    private float $pricePerHour = 10.0;

    public function __construct(EmployeeId $id, Hours $hoursWorked)
    {
        $this->id = $id;
        $this->hoursWorked = $hoursWorked;
    }

    /**
     * Calculate the salary of the employee
     */
    public function calculateSalary(Hours $hoursWorked): void
    {
        $this->salary = $this->pricePerHour * $hoursWorked->getHours();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->getId(),
            'hoursWorked' => $this->hoursWorked->getHours(),
            'salary' => $this->salary,
            'pricePerHour' => $this->pricePerHour,
        ];
    }
}
