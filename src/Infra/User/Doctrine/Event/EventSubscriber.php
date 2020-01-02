<?php

namespace App\Infra\User\Doctrine\Event;

use App\Domain\Common\Event\EventPublisher;
use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\Model\User;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber as EventSubscriberDoctrine;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class EventSubscriber implements EventSubscriberDoctrine
{
    public function getSubscribedEvents()
    {
        return array(
            Events::postPersist,
        );
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var User $entity */
        $entity = $user = $args->getObject();
        if(!$entity instanceof User) {
            return;
        }
        dump("ok");
        $event = new UserWasCreated($user->uuid(), $user->username(), $user->email());
        EventPublisher::raise($event);
    }
}