<?php declare(strict_types = 1);

namespace BDC\Framework\Rendering;

use Twig\Environment;

class TwigTemplateRenderer implements TemplateRenderer
{
    private $environment;

    public function __construct(Environment $environment) {
        $this->environment = $environment;
    }

    public function render(string $template, array $vars = []): string
    {
        return $this->environment->render($template, $vars);
    }
}
