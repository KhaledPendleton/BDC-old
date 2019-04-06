<?php declare(strict_types = 1);

namespace BDC\Error\Domain;

// Messages derived from - https://httpstatuses.com
class HttpError
{
    private $code;
    private $title;
    private $message;

    public function __construct(int $code, string $title, string $message) {
        $this->code = $code;
        $this->title = $title;
        $this->message = $message;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
