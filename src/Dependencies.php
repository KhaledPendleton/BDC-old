<?php declare(strict_types = 1);

use function DI\autowire;
use function DI\factory;
use function DI\get;

// Interfaces
use BDC\Framework\Rendering\TemplateRenderer;
use BDC\Newsletter\Application\EmailSubscribedQuery;
use BDC\Newsletter\Domain\SubscriberRepository;

// Factories
use BDC\Framework\Rendering\TwigTemplateRendererFactory;

// Implementable Classes
use BDC\Framework\Rendering\TemplateDirectory;
use BDC\Newsletter\Infrastructure\DbalEmailSubscribedQuery;
use BDC\Newsletter\Domain\DbalSubscriberRepository;

$dependencies = array();

// Template Rendering
$dependencies[TemplateDirectory::class] = autowire()
    ->constructorParameter('rootDirectory', ROOT_DIR);
$dependencies[TemplateRenderer::class] = factory([TwigTemplateRendererFactory::class, 'create']);

// Newsletter
$dependencies[EmailSubscribedQuery::class] = get(DbalEmailSubscribedQuery::class);
$dependencies[SubscriberRepository::class] = get(DbalSubscriberRepository::class);

return $dependencies;