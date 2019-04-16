<?php declare(strict_types = 1);

namespace BDC\Newsletter\Presentation;

// External packages
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

// Internal packages
use BDC\Framework\Rendering\TemplateRenderer;
use BDC\Newsletter\Application\SubscribeHandler;
use BDC\Framework\Csrf\StoredTokenValidator;
use BDC\Framework\Csrf\Token;
use BDC\Error\Application\UnprocessableEntityError;
use BDC\Error\Application\ForbiddenError;

final class NewsletterController
{
    private $templateRenderer;
    private $subscribeFormFactory;
    private $subscribeHandler;
    private $storedTokenValidator;

    public function __construct(
        TemplateRenderer $templateRenderer,
        SubscribeFormFactory $subscribeFormFactory,
        SubscribeHandler $subscribeHandler,
        StoredTokenValidator $storedTokenValidator
    ) {
        $this->templateRenderer = $templateRenderer;
        $this->subscribeFormFactory = $subscribeFormFactory;
        $this->subscribeHandler = $subscribeHandler;
        $this->storedTokenValidator = $storedTokenValidator;
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
        if (!$this->storedTokenValidator->validate(
            'subscribe',
            new Token((string)$request->get('token'))
        )) {
            $data = array();
            $data['error'] = ForbiddenError::create();

            $content = $this->templateRenderer->render('Pages/Error.html', $data);
            return new Response($content, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $form = $this->subscribeFormFactory->createFromRequest($request);

        if ($form->hasValidationErrors()) {
            $data = array();
            $data['error'] = UnprocessableEntityError::create();

            $content = $this->templateRenderer->render('Pages/Error.html', $data);
            return new Response($content, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->subscribeHandler->handle($form->toCommand());

        $firstName = $request->get('first-name');
        $response = new RedirectResponse('/newsletter/success?first-name='.$firstName);
        return $response;
    }
}