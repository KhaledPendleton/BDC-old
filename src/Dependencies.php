<?php declare(strict_types = 1);

use function DI\autowire;
use function DI\factory;
use function DI\env;
use function DI\get;

// Third-party
use Doctrine\DBAL\Connection;

// Interfaces
use BDC\Framework\Rendering\TemplateRenderer;
use BDC\Newsletter\Application\EmailSubscribedQuery;
use BDC\Newsletter\Domain\SubscriberRepository;

// Factories
use BDC\Framework\Rendering\TwigTemplateRendererFactory;
use BDC\Framework\Dbal\ConnectionFactory;

// Implementable Classes
use BDC\Framework\Dbal\ConnectionParamContainer;
use BDC\Framework\Rendering\TemplateDirectory;
use BDC\Newsletter\Infrastructure\DbalEmailSubscribedQuery;
use BDC\Newsletter\Infrastructure\DbalSubscriberRepository;

$dependencies = array();

// Database definitions
$dependencies['db.name'] = env('DB_NAME', 'bdc');
$dependencies['db.user'] = env('DB_USER', 'admin');
$dependencies['db.password'] = env('DB_PASSWORD', 'password');
$dependencies['db.host'] = env('DB_HOST', 'localhost');
$dependencies['db.driver'] = env('DB_DRIVER', 'pdo_mysql');
$dependencies['db.sslMode'] = env('DB_SSLMODE', '');
$dependencies['db.port'] = env('DB_PORT', '');

// Dbal Connection
$dependencies[ConnectionParamContainer::class] = autowire()
    ->constructorParameter('name', get('db.name'))
    ->constructorParameter('user', get('db.user'))
    ->constructorParameter('password', get('db.password'))
    ->constructorParameter('host', get('db.host'))
    ->constructorParameter('driver', get('db.driver'))
    ->constructorParameter('sslMode', get('db.sslMode'))
    ->constructorParameter('port', get('db.port'));

$dependencies[Connection::class] = factory([ConnectionFactory::class, 'create']);

// Template Rendering
$dependencies[TemplateDirectory::class] = autowire()
    ->constructorParameter('rootDirectory', ROOT_DIR);
$dependencies[TemplateRenderer::class] = factory([TwigTemplateRendererFactory::class, 'create']);

// Newsletter
$dependencies[EmailSubscribedQuery::class] = get(DbalEmailSubscribedQuery::class);
$dependencies[SubscriberRepository::class] = get(DbalSubscriberRepository::class);

return $dependencies;