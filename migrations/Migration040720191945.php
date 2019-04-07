<?php declare(strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema; 
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;

final class Migration040720191945
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function migrate(): void
    {
        $schema = new Schema();
        $this->createSubscriberTable($schema);

        $queries = $schema->toSql($this->connection->getDatabasePlatform());
        foreach ($queries as $query) {
            $this->connection->executeQuery($query);
        }
    }

    public function createSubscriberTable(Schema $schema): void
    {
        $table = $schema->createTable('subscriber');
        $table->addColumn('id', Type::GUID);
        $table->addColumn('first_name', Type::STRING);
        $table->addColumn('last_name', Type::STRING);
        $table->addColumn('email', Type::STRING);
        $table->addColumn('subscription_date', Type::DATETIME);
    }
}