<?php declare(strict_types = 1);

namespace BDC\Framework\Routing;

class Route
{
    private $method;
    private $path;
    private $callback;

    public function __construct(string $method, string $path, string $callback) {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getCallback(): string
    {
        return $this->callback;
    }

    public function toArray(): array
    {
        $temp = array(); 

        $temp[] = $this->getMethod();
        $temp[] = $this->getPath();
        $temp[] = $this->getCallback();

        return $temp;
    }
}
