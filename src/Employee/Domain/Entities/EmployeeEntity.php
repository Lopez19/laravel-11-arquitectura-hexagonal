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

    public function __construct(EmployeeId $id, Hours $hoursWorked)
    {
        $this->id = $id;
        $this->hoursWorked = $hoursWorked;
    }
}
