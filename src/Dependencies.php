<?php declare(strict_types = 1);

use function DI\autowire;
use function DI\factory;

use BDC\Framework\Rendering\TemplateRenderer;
use BDC\Framework\Rendering\TemplateDirectory;
use BDC\Framework\Rendering\TwigTemplateRendererFactory;

$dependencies = array();
$dependencies[TemplateDirectory::class] = autowire()->constructorParameter('rootDirectory', ROOT_DIR);
$dependencies[TemplateRenderer::class] = factory([TwigTemplateRendererFactory::class, 'create']);

return $dependencies;