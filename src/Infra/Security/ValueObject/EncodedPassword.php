<?php

namespace App\Infra\Security\ValueObject;

use App\Domain\Security\Exception\InvalidPasswordException;
use App\Domain\Security\Exception\NullPasswordException;
use App\Domain\Security\ValueObject\EncodedPasswordInterface;

use Symfony\Component\Security\Core\Encoder\SodiumPasswordEncoder;

/**
 * Class EncodedPassword
 *
 * @package App\Infra\Security\ValueObject
 */
final class EncodedPassword implements EncodedPasswordInterface
{
    const
        COST = 12
    ;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var SodiumPasswordEncoder
     */
    private $encoder;
    
    /**
     * EncodedPassword constructor.
     *
     * @param string|null $plainPassword
     *
     * @throws InvalidPasswordException
     * @throws NullPasswordException
     */
    public function __construct(?string $plainPassword = null)
    {
        if (null === $plainPassword) {

            throw new NullPasswordException();
        }

        $this->encoder = new SodiumPasswordEncoder(static::COST);

        $this->validate($plainPassword);

        $this->setPassword($plainPassword);
    }

    private function setPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;

        $this->password = $this->encoder->encodePassword($plainPassword, null);
    }

    public function matchHash(string $encodedPassword): bool
    {
        return password_verify($this->plainPassword, $encodedPassword);
    }

    /**
     * @param string|null $plainPassword
     * @throws InvalidPasswordException
     */
    private function validate(?string $plainPassword): void
    {
        if (8 > strlen($plainPassword)) {

            throw new InvalidPasswordException();
        }
    }

    public function __toString(): string
    {
        return $this->password;
    }
}
