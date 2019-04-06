<?php declare(strict_types = 1);

use function DI\autowire;
use function DI\factory;

// Interfaces
use BDC\Framework\Rendering\TemplateRenderer;

// Factories
use BDC\Framework\Rendering\TwigTemplateRendererFactory;

// Implementable Classes
use BDC\Framework\Rendering\TemplateDirectory;

$dependencies = array();

// Template Rendering
$dependencies[TemplateDirectory::class] = autowire()
    ->constructorParameter('rootDirectory', ROOT_DIR);
$dependencies[TemplateRenderer::class] = factory([TwigTemplateRendererFactory::class, 'create']);

// Newsletter

return $dependencies;