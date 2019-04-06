<?php declare(strict_types = 1);

namespace BDC\Framework\Dbal;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;

final class ConnectionFactory
{
    private $connectionParams;

    public function __construct(ConnectionParamContainer $connectionParams) {
        $this->connectionParams = $connectionParams;
    }

    public function create(): Connection
    {
        return DriverManager::getConnection(
            $this->connectionParams->toArray(),
            new Configuration()
        );
    }
}