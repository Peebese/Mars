<?php


namespace PhilipBrown\Mars\Application;

use DI\Container;


class ContainerBuilder
{
    public function build_container()
    {
        $containerArray = include __DIR__ .'/../../config/di.php';
        $container = new Container();

        foreach ($containerArray as $containerKey => $containerVal) {
            $container->set($containerKey, $containerVal);
        }

        return $container;
    }
}