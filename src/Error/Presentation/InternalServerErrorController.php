<?php declare(strict_types = 1);

namespace BDC\Error\Presentation;

use Symfony\Component\HttpFoundation\Response;
use BDC\Framework\Rendering\TemplateRenderer;
use BDC\Error\Application\InternalServerError;

final class InternalServerErrorController
{
    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer) {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(): Response
    {
        $data = array();
        $data['error'] = InternalServerError::create();

        $content = $this->templateRenderer->render('Pages/Error.html', $data);
        return new Response($content, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}