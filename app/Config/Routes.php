<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes
$routes->get('/', 'Home::index');
$routes->GET('signin', 'SigninController::index');
$routes->POST('SigninController/loginAuth', 'SigninController::loginAuth');
$routes->GET('signup', 'SignupController::index');
$routes->POST('SignupController/store', 'SignupController::store');
$routes->GET('logout', 'SigninController::logout');

// Authenticated routes
$routes->group('', ['filter' => 'authGuard'], function($routes) {
    $routes->GET('dashboard', 'Dashboard::index');

    // Plan routes
    $routes->GET('plans', 'TravelController::getPlans');
    $routes->POST('plans', 'TravelController::createPlan');
    $routes->GET('plans/view/(:num)', 'TravelController::getPlan/$1');
    $routes->GET('plans/edit/(:num)', 'TravelController::editPlan/$1');
    $routes->POST('plans/(:num)/update', 'TravelController::updatePlan/$1');
    $routes->POST('plans/(:num)/confirmations', 'TravelController::addConfirmation/$1');
    $routes->GET('plans/delete/(:num)', 'TravelController::deletePlan/$1');

    // Plan user management routes
    $routes->POST('plans/(:num)/users', 'TravelController::addUserToPlan/$1');
    $routes->GET('plans/remove-user/(:num)/(:any)', 'TravelController::removeUserFromPlan/$1/$2');
});

// Scraping Routes
$routes->get('flights', 'FlightsController::scrape');
$routes->get('flights/search', 'FlightsController::search');
$routes->get('hotels', 'HotelsController::scrape');
$routes->get('hotels/search', 'HotelsController::search');