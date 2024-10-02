<?php

declare(strict_types=1);

namespace Src\Employee\Domain\Exceptions;

final class IdNotValid extends \DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("The id {$id} is not valid");
    }
}
