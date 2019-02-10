<?php declare(strict_types = 1);

namespace BDC\FrontPage\Presentation;

use Symfony\Component\HttpFoundation\Response;
use BDC\Framework\Rendering\TemplateRenderer;

final class FrontPageController
{
    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer) {
        $this->templateRenderer = $templateRenderer;
    }

    public function show(): Response
    {
        $content = $this->templateRenderer->render('Pages/FrontPage.html');
        return new Response($content, Response::HTTP_OK);
    }
}