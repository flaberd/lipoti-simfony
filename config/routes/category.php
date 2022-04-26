<?php

use Lipoti\Shop\Category\Controller\CategoryController;
use Lipoti\Shop\Common\Builders\RouteLangPrefixBuilder;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('category_category', RouteLangPrefixBuilder::routeBuild('/category/{alias}'))
        ->controller(CategoryController::class)
    ;
};