<?php declare(strict_types = 1);

namespace BDC\Newsletter\Presentation;

use Symfony\Component\HttpFoundation\Request;

final class SubscribeFormFactory
{
    // private $emailSubscribedQuery;
    // EmailSubscribedQuery $emailSubscribedQuery
    public function __construct() {
        // $this->emailSubscribedQuery = $emailSubscribedQuery;
    }

    public function createFromRequest(Request $request): SubscribeForm
    {
        return new SubscribeForm(
            (string)$request->get('first-name'),
            (string)$request->get('last-name'),
            (string)$request->get('email')
        );
    }
}