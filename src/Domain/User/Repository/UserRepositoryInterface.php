<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Model\User;
use App\Domain\User\ValueObject\UserId;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Domain\User\Repository
 */
interface UserRepositoryInterface
{
    public function getOneByUuid(UserId $userId): User;

    public function findOneByUuid(UserId $userId): ?User;

    public function findOneByUsername(string $username): ?User;

    public function save(User $user): void;
}
