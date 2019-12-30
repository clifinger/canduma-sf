<?php

namespace App\Domain\User\Event;

use App\Domain\Common\Event\AbstractEvent;
use App\Domain\User\ValueObject\UserId;

class UserPasswordWasChanged extends AbstractEvent
{
    /**
     * @var string
     */
    private $userId;

    public function __construct(UserId $userId)
    {
        parent::__construct();
        $this->userId = (string) $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
