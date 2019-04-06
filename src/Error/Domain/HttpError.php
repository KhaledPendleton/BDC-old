<?php declare(strict_types = 1);

namespace BDC\Error\Domain;

// Messages derived from - https://httpstatuses.com
class HttpError
{
    private $code;
    private $message;

    public function __construct(int $code, string $message) {
        $this->code = $code;
        $this->message = $message;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
