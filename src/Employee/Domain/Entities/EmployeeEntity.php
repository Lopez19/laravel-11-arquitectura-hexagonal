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

    public function calculateSalary(Hours $hoursWorked): void
    {
        $this->salary = $this->pricePerHour * $hoursWorked->getHours();
    }
}
