<?php declare(strict_types = 1);

namespace BDC\Newsletter\Presentation;

use BDC\Newsletter\Application\EmailSubscribedQuery;
use BDC\Newsletter\Application\Subscribe;

final class SubscribeForm
{
    private $emailSubscribedQuery;
    private $firstName;
    private $lastName;
    private $email;

    public function __construct(
        EmailSubscribedQuery $emailSubscribedQuery,
        string $firstName,
        string $lastName,
        string $email
    ) {
        $this->emailSubscribedQuery = $emailSubscribedQuery;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getValidationErrors()
    {
        $errors = array();

        if (strlen($this->firstName) < 2 || strlen($this->firstName) > 50) { 
            $errors[] = 'First name must be between 2 and 50 characters';
        }

        if (strlen($this->lastName) < 2 || strlen($this->lastName) > 50) { 
            $errors[] = 'Last name must be between 2 and 50 characters';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email provided is not valid.';
        }

        if ($this->emailSubscribedQuery->execute($this->email)) {
            $errors[] = 'This email is already subscribed to our newsletter.';
        }

        return $errors;
    }

    public function hasValidationErrors(): bool
    {
        return (count($this->getValidationErrors()) > 0);
    }

    public function toCommand(): Subscribe
    {
        return new Subscribe(
            $this->firstName,
            $this->lastName,
            $this->email
        );
    }
}