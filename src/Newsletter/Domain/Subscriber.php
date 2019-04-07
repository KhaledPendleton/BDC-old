<?php declare(strict_types = 1);

namespace BDC\Newsletter\Domain;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

final class Subscriber
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $subscribedOn;

    public function __construct(
        UuidInterface $id,
        string $firstName,
        string $lastName,
        string $email,
        DateTimeImmutable $subscribedOn
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->subscribedOn = $subscribedOn;
    }

    public static function subscribe(string $firstName, string $lastName, string $email): Subscriber
    {
        return new Subscriber(
            Uuid::uuid4(),
            $firstName,
            $lastName,
            $email,
            new DateTimeImmutable()
        );
    }

    public function getId(): UuidInterface
    {
        return $this->id;
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