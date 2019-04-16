<?php declare(strict_types = 1);

namespace BDC\Error\Application;

use BDC\Error\Domain\HttpError;

class UnprocessableEntityError extends HttpError 
{
    public static function create(): UnprocessableEntityError
    {
        return new UnprocessableEntityError(422, 'Unprocessable Entity', 'The server understands the content type of the request entity, and the syntax of the request entity is correct but was unable to process the contained instructions.');
    }
}