<?php

namespace App\Domain\User\Model;

use Doctrine\Common\Collections\ArrayCollection;

use App\Domain\Common\ValueObject\AggregateRoot;
use App\Domain\User\Event\UserPasswordWasChanged;
use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\ValueObject\UserId;
use App\Domain\Security\ValueObject\AuthUser;
use App\Domain\Security\ValueObject\EncodedPasswordInterface;

/**
 * Class User
 *
 * @package App\Domain\User\Model
 */
class User extends AggregateRoot
{
    /**
     * @var UserId
     */
    protected $uuid;

    /**
     * @var string
     */
    private $email;

    /**
     * @var AuthUser
     */
    private $auth;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var null|\DateTime
     */
    private $updatedAt;

    public function __construct(
        UserId $userId,
        string $username,
        string $email,
        EncodedPasswordInterface $encodedPassword
    ) {
        parent::__construct($userId);

        $this->auth = new AuthUser($username, $encodedPassword);
        $this->setEmail($email);
        $this->createdAt = new \DateTime();
    }

    public static function create(
        UserId $userId,
        string $username,
        string $email,
        EncodedPasswordInterface $encodedPassword
    ): User {

        $user = new self($userId, $username, $email, $encodedPassword);

        $user->raise(
            new UserWasCreated($userId, $username, $email)
        );

        return $user;
    }

    public function changePassword(EncodedPasswordInterface $oldPassword, EncodedPasswordInterface $newPassword)
    {
        $this->auth->changePassword($oldPassword, $newPassword);

        $this->raise(
            new UserPasswordWasChanged($this->uuid)
        );
    }

    private function setEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            throw new \InvalidArgumentException("Invalid email $email");
        }

        $this->email = $email;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function username(): string
    {
        return $this->auth->username();
    }

    public function auth(): AuthUser
    {
        return $this->auth;
    }

    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }
}
