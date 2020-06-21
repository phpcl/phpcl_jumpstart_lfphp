<?php

declare(strict_types=1);

namespace Names\Handler;

use Names\Domain\ListService;
use Psr\Container\ContainerInterface;

class JsonNamesHandlerFactory
{
    public function __invoke(ContainerInterface $container) : JsonNamesHandler
    {
        return new JsonNamesHandler($container->get(ListService::class));
    }
}
