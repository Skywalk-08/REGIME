<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes
$routes->get('/', 'Home::index');

// Authentication routes
$routes->get('/auth/register-step1', 'Auth::registerStep1');
$routes->post('/auth/register-step1', 'Auth::registerStep1Post');
$routes->get('/auth/register-step2', 'Auth::registerStep2');
$routes->post('/auth/register-step2', 'Auth::registerStep2Post');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::loginPost');
$routes->get('/auth/logout', 'Auth::logout');

// Profile routes
$routes->get('/profile/complete', 'Profile::complete');
$routes->post('/profile/save-objectives', 'Profile::saveObjectives');
$routes->get('/profile/view', 'Profile::view');
$routes->get('/profile/edit', 'Profile::edit');
$routes->post('/profile/update', 'Profile::update');

// Dashboard routes
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/recommendations', 'Dashboard::getRecommendations');
$routes->post('/dashboard/subscribe-regime', 'Dashboard::subscribeRegime');
$routes->post('/dashboard/use-code', 'Dashboard::useCode');
$routes->post('/dashboard/upgrade-gold', 'Dashboard::upgradeGold');
$routes->get('/dashboard/active-regimes', 'Dashboard::activeRegimes');
$routes->post('/dashboard/cancel-regime', 'Dashboard::cancelRegime');

// Admin routes
$routes->group('admin', function($routes) {
    $routes->get('/', 'Admin\AdminDashboard::index');
    
    // Regime management
    $routes->get('/regimes', 'Admin\AdminDashboard::regimes');
    $routes->get('/regimes/create', 'Admin\AdminDashboard::createRegime');
    $routes->post('/regimes/store', 'Admin\AdminDashboard::storeRegime');
    $routes->get('/regimes/edit/(:num)', 'Admin\AdminDashboard::editRegime/$1');
    $routes->post('/regimes/update/(:num)', 'Admin\AdminDashboard::updateRegime/$1');
    $routes->post('/regimes/delete/(:num)', 'Admin\AdminDashboard::deleteRegime/$1');
    
    // Activity management
    $routes->get('/activites', 'Admin\AdminDashboard::activites');
    $routes->get('/activites/create', 'Admin\AdminDashboard::createActivite');
    $routes->post('/activites/store', 'Admin\AdminDashboard::storeActivite');
    $routes->post('/activites/delete/(:num)', 'Admin\AdminDashboard::deleteActivite/$1');
    
    // Code management
    $routes->get('/codes', 'Admin\AdminDashboard::codes');
    $routes->get('/codes/create', 'Admin\AdminDashboard::createCode');
    $routes->post('/codes/store', 'Admin\AdminDashboard::storeCode');
    $routes->post('/codes/delete/(:num)', 'Admin\AdminDashboard::deleteCode/$1');
});
