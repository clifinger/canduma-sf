<?php

namespace App\App\UseCase\User;

use App\App\UseCase\User\Request\Register;

use App\Domain\User\Model\User;
use App\Domain\User\Factory\UserFactoryInterface;
use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class RegisterUserHandler
 * 
 * @package App\App\UseCase\User
 */
class RegisterUserHandler implements MessageHandlerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;
    
    /**
     * @var UserFactoryInterface
     */
    private $factory;

    public function __construct(UserRepositoryInterface $repository, UserFactoryInterface $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    public function __invoke(Register $request): User
    {
        /** @var User $user */
        $user = $this->factory->register($request->toForm());
        
        $this->repository->save($user);

        return $user;
    }
}
