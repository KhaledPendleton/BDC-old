<?php declare(strict_types = 1);

namespace BDC\Error\Application;

use BDC\Error\Domain\HttpError;

class ForbiddenError extends HttpError 
{
    public static function create(): ForbiddenError
    {
        return new ForbiddenError(403, 'Forbidden', 'The server understood the request but refuses to authorize it.');
    }
}