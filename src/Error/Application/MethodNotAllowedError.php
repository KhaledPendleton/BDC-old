<?php declare(strict_types = 1);

namespace BDC\Error\Application;

use BDC\Error\Domain\HttpError;

class MethodNotAllowedError extends HttpError 
{
    public static function create(): MethodNotAllowedError
    {
        return new MethodNotAllowedError(405, 'METHOD NOT ALLOWED', 'The method received in the request-line is known by the origin server but not supported by the target resource.');
    }
}