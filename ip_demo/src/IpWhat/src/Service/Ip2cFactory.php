<?php

declare(strict_types=1);

namespace IpWhat\Service;

use Psr\Container\ContainerInterface;

class Ip2cFactory
{
    public function __invoke(ContainerInterface $container) : Ip2c
    {
        return new Ip2c();
    }
}
