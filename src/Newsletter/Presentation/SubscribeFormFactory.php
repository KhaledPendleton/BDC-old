<?php declare(strict_types = 1);

namespace BDC\Newsletter\Presentation;

use Symfony\Component\HttpFoundation\Request;
use BDC\Newsletter\Application\EmailSubscribedQuery;

final class SubscribeFormFactory
{
    private $emailSubscribedQuery;

    public function __construct(EmailSubscribedQuery $emailSubscribedQuery) {
        $this->emailSubscribedQuery = $emailSubscribedQuery;
    }

    public function createFromRequest(Request $request): SubscribeForm
    {
        return new SubscribeForm(
            $this->emailSubscribedQuery,
            (string)$request->get('first-name'),
            (string)$request->get('last-name'),
            (string)$request->get('email')
        );
    }
}