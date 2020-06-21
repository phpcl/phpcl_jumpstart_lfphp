<?php

declare(strict_types=1);

namespace Names;

use Laminas\Db\Adapter\Adapter;
/**
 * The configuration provider for the Names module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
				Domain\Adapter::class => function ($container) {
					return new Adapter($container->get('db-config'));
				}				
				Domain\ListService::class => Domain\ListServiceFactory::class,
				Handler\ListNamesHandler::class => Handler\ListNamesHandlerFactory::class,
           ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'names'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
