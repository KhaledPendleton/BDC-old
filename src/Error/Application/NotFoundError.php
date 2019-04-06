<?php declare(strict_types = 1);

namespace BDC\Error\Application;

use BDC\Error\Domain\HttpError;

class NotFoundError extends HttpError 
{
    public static function create(): NotFoundError
    {
        return new NotFoundError(404, 'NOT FOUND', 'The origin server did not find a current representation for the target resource or is not willing to disclose that one exists.');
    }
}
