<?php declare(strict_types = 1);

namespace BDC\Error\Application;

use BDC\Error\Domain\HttpError;

class InternalServerError extends HttpError
{
    public static function create(): InternalServerError
    {
        return new InternalServerError(500, 'INTERNAL SERVER ERROR', 'The server encountered an unexpected condition that prevented it from fulfilling the request.');
    }
}