<?php declare(strict_types = 1);

namespace BDC\Framework\Rendering;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

final class TwigTemplateRendererFactory
{
    private $templateDirectory;

    public function __construct(TemplateDirectory $templateDirectory) {
        $this->templateDirectory = $templateDirectory;
    }

    public function create(): TwigTemplateRenderer
    {
        $loader = new FilesystemLoader($this->templateDirectory->toString());
        $environment = new Environment($loader);

        return new TwigTemplateRenderer($environment);
    }
}
