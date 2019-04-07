<?php declare(strict_types = 1);

namespace BDC\Newsletter\Infrastructure;

use BDC\Newsletter\Application\EmailSubscribedQuery;

final class DbalEmailSubscribedQuery implements EmailSubscribedQuery
{
    public function execute(string $email): bool
    {
        return true;
    }
}