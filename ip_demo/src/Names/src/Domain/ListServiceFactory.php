<?php

declare(strict_types=1);

namespace Names\Domain;

use Psr\Container\ContainerInterface;

class ListServiceFactory
{
    public function __invoke(ContainerInterface $container) : ListService
    {
        return new ListService(
            $container->get(Adapter::class),
        );
    }
}
