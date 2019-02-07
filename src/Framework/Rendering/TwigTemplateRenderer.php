<?php declare(strict_types = 1);

namespace BDC\Framework\Rendering;

use Twig_Environment;

class TwigTemplateRenderer implements TemplateRenderer
{
    private $twigEnvironment;

    public function __construct(Twig_Environment $twigEnvironment) {
        $this->twigEnvironment = $twigEnvironment;
    }

    public function render(string $template, array $data = []): string
    {
        return $this->twigEnvironment->render($template, $data);
    }
}
