<?php declare(strict_types = 1);

namespace BDC\Newsletter\Application;

interface EmailSubscribedQuery
{
    public function execute(string $email): bool;
}