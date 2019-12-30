<?php

namespace App\App\UseCase\Security;

use App\App\UseCase\Security\Request\Login;

use App\Domain\Security\Exception\AuthenticationException;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;

use App\Infra\Security\Model\Auth;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class LoginHandler
 *
 * @package App\App\UseCase\Security
 */
class LoginHandler
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var JWTTokenManagerInterface
     */
    private $JWTManager;

    /**
     * LoginHandler constructor.
     *
     * @param AuthenticationUtils $authenticationUtils
     * @param UserRepositoryInterface $userRepository
     * @param EncoderFactoryInterface $encoderFactory
     * @param JWTTokenManagerInterface $JWTManager
     */
    public function __construct(
        AuthenticationUtils $authenticationUtils,
        UserRepositoryInterface $userRepository,
        EncoderFactoryInterface $encoderFactory,
        JWTTokenManagerInterface $JWTManager
    )
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
        $this->JWTManager = $JWTManager;
    }

    /**
     * @param Login $request
     * @return string
     * @throws AuthenticationException
     */
    public function handle(Login $request): string
    {
        /** @var User $user */
        $user = $this->userRepository->findOneByUsername($request->username());

        if (!$user) {

            throw new AuthenticationException();
        }

        $authUser = new Auth(
            (string) $user->uuid(),
            $user->auth()
        );

        $encoder = $this->encoderFactory->getEncoder($authUser);

        if (!$encoder->isPasswordValid($authUser->getPassword(), $request->plainPassword(), $authUser->getSalt())) {

            throw new AuthenticationException();
        }

        return $this->JWTManager->create($authUser);
    }
}
