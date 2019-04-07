<?php declare(strict_types = 1);

namespace BDC\Newsletter\Infrastructure;

use Doctrine\DBAL\Connection;

use BDC\Newsletter\Application\EmailSubscribedQuery;

final class DbalEmailSubscribedQuery implements EmailSubscribedQuery
{
    private $connection;

    public function __construct(connection $connection) {
        $this->connection = $connection;
    }

    public function execute(string $email): bool
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder->select('count(*)');
        $queryBuilder->from('subscriber');
        $queryBuilder->where("email = {$queryBuilder->createNamedParameter($email)}");

        $stmt = $queryBuilder->execute();
        return (bool)$stmt->fetchColumn();
    }
}