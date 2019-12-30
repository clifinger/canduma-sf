<?php

namespace App\Infra\User\Factory;

use App\Domain\User\Factory\UserFactoryInterface;
use App\Domain\User\Model\User;
use App\Infra\Common\Factory\AbstractFactory;
use App\Infra\User\Factory\Form\RegisterType;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * Class UserFactory
 *
 * @package App\Infra\User\Factory
 */
class UserFactory extends AbstractFactory implements UserFactoryInterface
{
    public function __construct(FormFactoryInterface $factory)
    {
        $this->formClass = RegisterType::class;
        parent::__construct($factory);
    }

    public function register(array $data): User
    {
        return $this->execute(self::CREATE, $data);
    }
}
