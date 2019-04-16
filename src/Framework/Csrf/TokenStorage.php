<?php declare(strict_types = 1);

namespace BDC\Framework\Csrf;

interface TokenStorage
{
    public function store(string $key, Token $token): void;
    public function retrieve(string $key): ?Token;
}