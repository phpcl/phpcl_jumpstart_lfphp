<?php

declare(strict_types=1);

namespace Names\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ListNamesHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ListNamesHandler
    {
        return new ListNamesHandler($container->get(TemplateRendererInterface::class));
    }
}
