<?php declare(strict_types = 1);

namespace BDC\FrontPage\Presentation;

use Symfony\Component\HttpFoundation\Response;

class FrontPageController
{
    public function show(): Response
    {
        return new Response("Front page", Response::HTTP_OK);
    }
}