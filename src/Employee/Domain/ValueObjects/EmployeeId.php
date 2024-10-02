<?php

declare(strict_types=1);

namespace App\Employee\Domain\ValueObjects;

use Src\Employee\Domain\Exceptions\IdNotValid;

final class EmployeeId
{
    /**
     * @var int
     */
    private int $id;

    public function __construct(int $id)
    {
        $this->setId($id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private function setId(int $id): void
    {
        if ($id <= 0) {
            throw new IdNotValid($id);
        }

        $this->id = $id;
    }
}
