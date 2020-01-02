<?php

namespace App\App\UseCase\User\Request;

use App\Domain\User\ValueObject\UserId;

/**
 * Class GetUser
 *
 * @package App\App\UseCase\User\Request
 */
class GetUser
{
    /**
     * @var UserId
     */
    private UserId $uuid;

    /**
     * GetUser constructor.
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = new UserId($uuid);
    }

    /**
     * @return UserId
     */
    public function uuid(): UserId
    {
        return $this->uuid;
    }
}