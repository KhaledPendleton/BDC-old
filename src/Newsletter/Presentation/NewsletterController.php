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

    public function success(Request $request, array $vars): Response
    {
        $firstName = ucwords($request->query->get('first-name', ''));
        $content = $this->templateRenderer->render(
            'Pages/NewsletterSuccess.html',
            array('firstName' => $firstName)
        );

        $response = new Response($content, Response::HTTP_OK);
        return $response;
    }

    public function subscribe(Request $request, array $vars): Response
    {
        $firstName = $request->get('first-name');
        $response = new RedirectResponse('/newsletter/success?first_name='.$firstName);
        return $response;
    }
}