<?php

declare(strict_types=1);

namespace Src\Employee\Application\UseCases;

use App\Employee\Domain\ValueObjects\EmployeeId;
use App\Employee\Domain\ValueObjects\Hours;
use Src\Employee\Domain\Entities\EmployeeEntity;

final class UpdateSalaryUseCase
{

    /**
     * @var SearchEmployeeUseCase
     */
    private $finder;

    /**
     * Constructor to inject dependencies
     */
    public function __construct()
    {
        $this->finder = new SearchEmployeeUseCase();
    }

    /**
     * Execute the use case
     */
    public function execute(int $id, int $hoursWorked)
    {
        $this->finder->execute($id);

        $employee = new EmployeeEntity(
            new EmployeeId($id),
            new Hours($hoursWorked)
        );
    }
}
