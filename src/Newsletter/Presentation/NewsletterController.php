<?php declare(strict_types = 1);

namespace BDC\Newsletter\Presentation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use BDC\Framework\Rendering\TemplateRenderer;

final class NewsletterController
{
    private $templateRenderer;

    public function __construct(TemplateRenderer $templateRenderer) {
        $this->templateRenderer = $templateRenderer;
    }
    
    // Show current newsletter
    public function show(): Response
    {}

    public function success(): Response
    {
        $content = $this->templateRenderer->render('Pages/NewsletterSuccess.html');
        $response = new Response($content, Response::HTTP_OK);
    }

    public function subscribe(Request $request, array $vars): Response
    {
        $response = new RedirectResponse('/newsletter/success');
        return $response;
    }
}