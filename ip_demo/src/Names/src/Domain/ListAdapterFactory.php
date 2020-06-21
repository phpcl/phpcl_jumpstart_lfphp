<?php
declare(strict_types=1);
namespace Names\Domain;

use Laminas\Db\Adapter\Adapter;
use Psr\Container\ContainerInterface;

class ListAdapterFactory
{
    public function __invoke(ContainerInterface $container) : Adapter
    {
		return new Adapter($container->get('db-config'));
    }
}
