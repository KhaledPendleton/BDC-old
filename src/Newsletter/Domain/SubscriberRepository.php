<?php declare(strict_types = 1);

namespace BDC\Newsletter\Domain;

interface SubscriberRepository
{
    public function findByEmail(string $email);
}