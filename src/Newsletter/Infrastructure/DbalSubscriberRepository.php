<?php declare(strict_types = 1);

namespace BDC\Newsletter\Infrastructure;

use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;

use BDC\Newsletter\Domain\SubscriberRepository;
use BDC\Newsletter\Domain\Subscriber;

final class DbalSubscriberRepository implements SubscriberRepository
{
    private $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    public function add(Subscriber $subscriber): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->insert('subscriber');
        $queryBuilder->values(array(
            'id' => $queryBuilder->createNamedParameter($subscriber->getId()->toString()),
            'first_name' => $queryBuilder->createNamedParameter($subscriber->getFirstName()),
            'last_name' => $queryBuilder->createNamedParameter($subscriber->getLastName()),
            'email' => $queryBuilder->createNamedParameter($subscriber->getEmail()),
            'subscribed_on' => $queryBuilder->createNamedParameter(
                $subscriber->getSubscribedOn(), 
                Type::DATETIME
            )
        ));

        $queryBuilder->execute();
    }

    public function findByEmail(string $email): ?Subscriber
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->addSelect('id');
        $queryBuilder->addSelect('first_name');
        $queryBuilder->addSelect('last_name');
        $queryBuilder->addSelect('email');
        $queryBuilder->addSelect('subscribed_on');
        $queryBuilder->from('subscriber');
        $queryBuilder->where("email = {$queryBuilder->createNamedParameter($email)}");

        $stmt = $queryBuilder->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return $this->createFromRow($row);
    }

    public function createFromRow(array $row): ?Subscriber
    {
        if (!$row) {
            return null;
        }

        return new Subscriber(
            Uuid::fromString($row['id']),
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            new DateTimeImmutable($row['subscribed_on'])
        );
    }
}