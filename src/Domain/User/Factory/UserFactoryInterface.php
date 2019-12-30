<?php

namespace App\Domain\User\Factory;

use App\Domain\User\Model\User;

/**
 * Interface UserFactoryInterface
 *
 * @package App\Domain\User\Factory
 */
interface UserFactoryInterface
{
    public function register(array $data): User;
}
