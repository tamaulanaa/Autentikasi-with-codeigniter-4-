<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('', static function ($routes) {
    $routes->get('/register', 'Auth::index');
    $routes->post('/user/save', 'Auth::save');
    $routes->get('/login', 'Auth::Login');
    $routes->post('/user/masuk', 'Auth::login_action');
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/login/logout', 'Auth::Logout');
    $routes->get('/forgot', 'Auth::forgot', ['as' => 'forgot']);
    $routes->post('/forgot/forgotPassword', 'Auth::forgotPassword');
    $routes->get('/forgot/reset/(:any)', 'Auth::reset/$1', ['as' => 'reset']);
    $routes->post('/forgot/resetpassword/(:any)', 'Auth::resetPassword/$1');
    $routes->get('/register/actived/(:any)', 'Auth::actived/$1');
});
