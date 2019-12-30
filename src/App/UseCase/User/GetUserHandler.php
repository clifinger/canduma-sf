<?php

namespace App\App\UseCase\User;

use App\App\UseCase\User\Request\GetUser;

use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;

/**
 * Class GetUserHandler
 *
 * @package App\App\UseCase\User
 */
class GetUserHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param GetUser $request
     * @return User
     */
    public function handle(GetUser $request): User
    {
        return $this->repository->getOneByUuid($request->uuid());
    }
}
