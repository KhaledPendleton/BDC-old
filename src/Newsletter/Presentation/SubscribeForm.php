<?php declare(strict_types = 1);

namespace BDC\Newsletter\Presentation;

final class SubscribeForm
{
    private $firstName;
    private $lastName;
    private $email;

    public function __construct(string $firstName, string $lastName, string $email) {
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

        // if ($this->emailSubscribedQuery->execute($this->email)) {
        //     $errors[] = 'This email is already subscribed to our newsletter.';
        // }

        return $errors;
    }

    public function hasValidationErrors(): bool
    {
        return (count($this->getValidationErrors()) > 0);
    }
}