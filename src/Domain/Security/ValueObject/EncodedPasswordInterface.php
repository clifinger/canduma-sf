<?php

namespace App\Domain\Security\ValueObject;

/**
 * Interface EncodedPasswordInterface
 *
 * @package App\Domain\Security\ValueObject
 */
interface EncodedPasswordInterface
{
    public function __construct(string $plainPassword);

    public function matchHash(string $hash): bool;

    public function __toString(): string;
}
