<?php declare(strict_types = 1);

namespace BDC\Framework\Dbal;

final class ConnectionParamContainer
{
    private $name;
    private $user;
    private $password;
    private $host;
    private $driver;
    private $sslMode;
    private $port;

    public function __construct(
        string $name,
        string $user,
        string $password,
        string $host,
        string $driver,
        string $sslMode,
        string $port
    ) {
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
        $this->driver = $driver;
        $this->sslMode = $sslMode;
        $this->port = $port;
    }

    public function toArray(): array
    {
        $temp = array();

        $temp['dbname'] = $this->name;
        $temp['user'] = $this->user;
        $temp['password'] = $this->password;
        $temp['host'] = $this->host;
        $temp['driver'] = $this->driver;
        $temp['sslmode'] = $this->sslMode;
        $temp['port'] = $this->port;

        return $temp;
    }
}