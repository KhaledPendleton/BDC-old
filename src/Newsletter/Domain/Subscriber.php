<?php declare(strict_types = 1);

namespace BDC\Newsletter\Domain;

use DateTimeImmutable;

final class Subscriber
{
    private $firstName;
    private $lastName;
    private $email;
    private $subscribedOn;

    public function __construct(string $firstName, string $lastName, string $email, DateTimeImmutable $subscribedOn) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->subscribedOn = $subscribedOn;
    }
    
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function getSubscribedOn(): DateTimeImmutable
    {
        return $this->subscribedOn;
    }
}