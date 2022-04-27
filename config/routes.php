<?php

use Lipoti\Shop\Category\Controller\CategoryController;
use Lipoti\Shop\Common\Builders\RouteLangPrefixBuilder;
use Lipoti\Shop\Core\Controller\HomePageController;
use Lipoti\Shop\User\Controller\Registration\RegistrationController;
use Lipoti\Shop\User\Controller\Registration\RegistrationSuccessController;
use Lipoti\Shop\User\Controller\Security\LoginController;
use Lipoti\Shop\User\Controller\Security\LogoutController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;


return function (RoutingConfigurator $routes) {

    $routes->add('core_home', RouteLangPrefixBuilder::routeBuild(''))
        ->controller(HomePageController::class)
    ;

    $routes->add('app_login', RouteLangPrefixBuilder::routeBuild('/login'))
        ->controller(LoginController::class)
    ;

    $routes->add('app_logout', RouteLangPrefixBuilder::routeBuild('/logout'))
        ->controller(LogoutController::class)
    ;

    $routes->add('user_user_registration', RouteLangPrefixBuilder::routeBuild('/registration'))
        ->controller(RegistrationController::class)
    ;

    $routes->add('user_user_registration_success', RouteLangPrefixBuilder::routeBuild('/registration-success'))
        ->controller(RegistrationSuccessController::class)
    ;

    $routes->add('category_category', RouteLangPrefixBuilder::routeBuild('/shop/{alias}'))
        ->controller(CategoryController::class)
    ;
};