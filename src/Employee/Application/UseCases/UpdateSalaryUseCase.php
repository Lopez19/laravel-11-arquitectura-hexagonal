<?php

declare(strict_types=1);

namespace Src\Employee\Application\UseCases;

use App\Employee\Domain\ValueObjects\Hours;
use Src\Employee\Domain\Contracts\EmployeeRepository;

final class UpdateSalaryUseCase
{

    /**
     * @var SearchEmployeeUseCase
     */
    private $finder;

    /**
     * @var EmployeeRepository
     */
    private $repository;

    /**
     * Constructor to inject dependencies
     */
    public function __construct(
        EmployeeRepository $repository
    ) {
        $this->repository = $repository;
        $this->finder = new SearchEmployeeUseCase($this->repository);
    }

    /**
     * Execute the use case
     */
    public function execute(int $id, int $hoursWorked)
    {
        $employeeEntity = $this->finder->execute($id);
        $employeeEntity->calculateSalary(new Hours($hoursWorked));
        $this->repository->save($employeeEntity);
    }
}
