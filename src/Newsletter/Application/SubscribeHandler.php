<?php declare(strict_types = 1);

namespace BDC\Newsletter\Application;

use BDC\Newsletter\Domain\SubscriberRepository;
use BDC\Newsletter\Domain\Subscriber;

final class SubscribeHandler
{
    private $subscriberRepository;

    public function __construct(SubscriberRepository $subscriberRepository) {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function handle(Subscribe $command): void
    {
        $subscriber = Subscriber::subscribe(
            $command->getFirstName(),
            $command->getLastName(),
            $command->getEmail()
        );

        $this->subscriberRepository->add($subscriber);
    }
}