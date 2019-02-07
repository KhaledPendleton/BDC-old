<?php declare(strict_types = 1);

namespace BDC\Error\Presentation;

use Symfony\Component\HttpFoundation\Response;
use BDC\Framework\Rendering\TemplateRenderer;
use BDC\Error\Application\MethodNotAllowedError;

final class MethodNotAllowedController
{
    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer) {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(): Response
    {
        $data = array();
        $data['error'] = MethodNotAllowedError::create();

        $content = $this->templateRenderer->render('Pages/Error.html', $data);
        return new Response($content, Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
