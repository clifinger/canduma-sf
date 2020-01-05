<?php


namespace App\Infra\User\Messenger;


use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\Model\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\ValueObject\UserId;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;

class UserWasCreatedHandler implements MessageHandlerInterface
{
    private UserRepositoryInterface $repository;
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;

    public function __construct(UserRepositoryInterface $repository, MailerInterface $mailer)
    {
        $this->repository = $repository;
        $this->mailer = $mailer;
    }

    public function __invoke(UserWasCreated $userWasCreated)
    {
        /** @var User $user */
        $user = $this->repository->findOneByUuid(new UserId($userWasCreated->userId()));

        $email = (new Email())
            ->from('admin@canduma.com')
            ->to($user->email())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Welcome to Canduma ' . $user->username(). '!')
            ->text('Registred')
            ->html('<p>Cool !</p>');

        $sentEmail = $this->mailer->send($email);

        // ... send an email!
    }
}