<?php

declare(strict_types=1);

namespace Src\Employee\Application\UseCases;

use App\Employee\Domain\ValueObjects\EmployeeId;
use Src\Employee\Domain\Contracts\EmployeeRepository;
use Src\Employee\Domain\Entities\EmployeeEntity;

final class SearchEmployeeUseCase
{

    /**
     * @var EmployeeRepository
     */
    private $repository;

    /**
     * Constructor
     */
    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Execute the use case
     */
    public function execute(int $id): ?EmployeeEntity
    {
        return $this->repository->search(new EmployeeId($id));
    }
}
