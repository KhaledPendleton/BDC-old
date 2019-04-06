<?php declare(strict_types = 1);

namespace BDC\Framework\Routing;

final class Route
{
    private $method;
    private $path;
    private $controller;

    public function __construct(string $method, string $path, string $controller) {
        $this->method = $method;
        $this->path = $path;
        $this->controller = $controller;
    }

    public function toArray()
    {
        $temp = array();

        // ORDER COUNTS
        $temp[] = $this->method;
        $temp[] = $this->path;
        $temp[] = $this->controller;

        return $temp;
    }
}