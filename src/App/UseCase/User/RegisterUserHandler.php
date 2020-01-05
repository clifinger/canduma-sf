<?php

namespace App\App\UseCase\User;

use App\App\UseCase\User\Request\Register;

use App\Domain\Common\Message\MessageTransportInterface;
use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\Model\User;
use App\Domain\User\Factory\UserFactoryInterface;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\UserId;

/**
 * Class RegisterUserHandler
 * 
 * @package App\App\UseCase\User
 */
class RegisterUserHandler
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;
    
    /**
     * @var UserFactoryInterface
     */
    private UserFactoryInterface $factory;

    /**
     * @var MessageTransportInterface
     */
    private MessageTransportInterface $eventBus;

    public function __construct(UserRepositoryInterface $repository, UserFactoryInterface $factory, MessageTransportInterface $eventBus)
    {
        $this->repository = $repository;
        $this->factory = $factory;
        $this->eventBus = $eventBus;
    }

    public function __invoke(Register $request): User
    {
        /** @var User $user */
        $user = $this->factory->register($request->toForm());
        
        $this->repository->save($user);
        $uuid = new UserId($user->uuid());

        $this->eventBus->dispatchRoutedMessageAfterMiddleware(
            new UserWasCreated(
                new UserId($user->uuid()),
                $user->username(),
                $user->email()
            )
        );

        return $user;
    }
}
