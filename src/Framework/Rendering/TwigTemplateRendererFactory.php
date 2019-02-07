<?php declare(strict_types = 1);

namespace BDC\Framework\Rendering;

use Twig_Loader_Filesystem;
use Twig_Environment;

final class TwigTemplateRendererFactory
{
    private $templateDirectory;

    public function __construct(TemplateDirectory $templateDirectory) {
        $this->templateDirectory = $templateDirectory;
    }

    public function create(): TemplateRenderer
    {
        $templateDirectory = $this->templateDirectory->toString();
        $loader = new Twig_Loader_Filesystem($templateDirectory);
        $twig = new Twig_Environment($loader, array());
        
        return new TwigTemplateRenderer($twig);
    }
}
