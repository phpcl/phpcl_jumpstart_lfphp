<?php

declare(strict_types=1);

namespace IpWhat\Handler;

use IpWhat\Service\Ip2c;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class IpHandlerFactory
{
    public function __invoke(ContainerInterface $container) : IpHandler
    {
        return new IpHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(Ip2c::class)
        );
    }
}
