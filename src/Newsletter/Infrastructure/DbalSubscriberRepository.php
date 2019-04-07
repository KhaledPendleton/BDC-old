<?php declare(strict_types = 1);

namespace BDC\Newsletter\Infrastructure;

use Doctrine\DBAL\Connection;
use BDC\Newsletter\Domain\SubscriberRepository;

final class DbalSubscriberRepository implements SubscriberRepository
{
    private $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    public function findByEmail(string $email)
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->addSelect('id');
        $queryBuilder->addSelect('first_name');
        $queryBuilder->addSelect('last_name');
        $queryBuilder->addSelect('email');
        $queryBuilder->from('subscriber');
        $queryBuilder->where("email = {$queryBuilder->createNamedParameter($email)}");

        $stmt = $queryBuilder->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return $row;
    }
}