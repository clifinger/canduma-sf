<?php


namespace App\UI\Controller\Api\User;

use App\App\UseCase\User\Request\Register as RegisterUseCase;

use App\Domain\Common\Event\EventDispatcherInterface;
use App\Domain\User\Model\User;
use App\Domain\User\ValueObject\UserId;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use Symfony\Component\Routing\Annotation\Route;

final class Register
{
    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $bus;


    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @Route("/api/user/register", name="app_api_user_register")
     */
    public function __invoke()
    {
        // TODO: Accept JSON body and return Serialized JSON
        /** @var User $user */
        $user = $this->bus->dispatch(
            new RegisterUseCase(
                new UserId(),
                'Jujddkfjkddshnzze',
                'c@vgasssddddkkszzdddd.com',
                'password'
            )
        );
        return new Response(
            '<html><body>Registered</body></html>'
        );
    }
}