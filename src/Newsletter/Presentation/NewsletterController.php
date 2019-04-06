<?php declare(strict_types = 1);

namespace BDC\Newsletter\Presentation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use BDC\Framework\Rendering\TemplateRenderer;

final class NewsletterController
{
    private $templateRenderer;
    private $subscribeFormFactory;

    public function __construct(
        TemplateRenderer $templateRenderer,
        SubscribeFormFactory $subscribeFormFactory
    ) {
        $this->templateRenderer = $templateRenderer;
        $this->subscribeFormFactory = $subscribeFormFactory;
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
        $form = $this->subscribeFormFactory->createFromRequest($request);

        if ($form->hasValidationErrors()) {
            $errors = $form->getValidationErrors();
            // TODO: Handle this
            return new Response('error', Response::HTTP_NOT_ACCEPTABLE);
        }

        $firstName = $request->get('first-name');
        $response = new RedirectResponse('/newsletter/success?first-name='.$firstName);
        return $response;
    }
}