<?php declare(strict_types = 1);

namespace BDC\Newsletter\Infrastructure;

final class DbalEmailSubscribedQuery
{
    public function execute(string $email): bool
    {
        return true;
    }
}