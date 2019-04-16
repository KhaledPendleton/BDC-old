<?php declare(strict_types = 1);

namespace BDC\Framework\Rendering;

// External packages
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use Twig\Environment;

// Internal packages
use BDC\Framework\Csrf\StoredTokenReader;

final class TwigTemplateRendererFactory
{
    private $templateDirectory;
    private $storedTokenReader;

    public function __construct(
        TemplateDirectory $templateDirectory,
        StoredTokenReader $storedTokenReader
    ) {
        $this->templateDirectory = $templateDirectory;
        $this->storedTokenReader = $storedTokenReader;
    }

    public function create(): TwigTemplateRenderer
    {
        $loader = new FilesystemLoader($this->templateDirectory->toString());
        $environment = new Environment($loader);
        $environment->addFunction(
            new TwigFunction('getToken', function(string $key): string {
                $token = $this->storedTokenReader->read($key);
                return $token->toString();
            })
        );

        return new TwigTemplateRenderer($environment);
    }
}
