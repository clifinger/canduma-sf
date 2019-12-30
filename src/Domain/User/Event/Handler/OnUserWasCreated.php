<?php

namespace App\Domain\User\Event\Handler;

use App\Infra\Common\Event\EventAware;

class OnUserWasCreated
{

    public function __invoke(EventAware $eventAware): void
    {
    }
}
