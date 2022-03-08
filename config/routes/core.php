<?php
use Lipoti\Shop\Common\Builders\RouteLangPrefixBuilder;
use Lipoti\Shop\Core\Controller\HomePageController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;


return function (RoutingConfigurator $routes) {

    $routes->add('core_home', RouteLangPrefixBuilder::routeBuild(''))
        ->controller(HomePageController::class)
    ;
};