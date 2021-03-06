<?php

namespace App\App\UseCase\User\Request;

use App\Domain\User\ValueObject\UserId;

/**
 * Class Register
 * 
 * @package App\App\UseCase\User\Request
 */
class Register
{
    /**
     * @var string
     */
    private string $username;
    
    /**
     * @var string
     */
    private string $email;
    
    /**
     * @var string
     */
    private string $plainPassword;

    /**
     * @var UserId
     */
    private UserId $userId;

    public function __construct(UserId $userId, string $username, string $email, string $plainPassword)
    {
        $this->username = $username;
        $this->email = $email;
        $this->plainPassword = $plainPassword;
        $this->userId = $userId;
    }

    public function toForm(): array
    {
        return [
            'uuid'      => $this->userId,
            'username'  => $this->username,
            'email'     => $this->email,
            'password'  => $this->plainPassword
        ];
    }
}
