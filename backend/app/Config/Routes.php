<?php

namespace Config;

use App\Libraries\Hash;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Login::index');

$routes->group('/', ['filter' => 'AlreadyLoggedIn'], function ($routes) {
    $routes->get('', 'Login::login');
    $routes->get('login', 'Login::login');
    $routes->get('create', 'Login::create');
    $routes->post('check', 'Login::check');
    $routes->post('recover', 'Login::recover');
});
$routes->group('/', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->group('dashboard/', static function ($routes) {
        $routes->get(Hash::path('index'), 'Dashboard::index');
    });
    $routes->group('products/', static function ($routes) {
        $routes->get(Hash::path('view'), 'Products::view');
    });
    $routes->group('quantity/', static function ($routes) {
        $routes->get(Hash::path('view'), 'Quantity::view');
    });
    $routes->group('pricelist/', static function ($routes) {
        $routes->get(Hash::path('view'), 'Pricelist::view');
    });
    $routes->group('booking/', static function ($routes) {
        $routes->get(Hash::path('view'), 'Booking::view');
        $routes->get(Hash::path('add'), 'Booking::add');
        $routes->post(Hash::path('addAction'), 'Booking::addAction');
    });
    $routes->group('expenses/', static function ($routes) {
        $routes->get(Hash::path('view'), 'Expenses::view');
        $routes->get(Hash::path('add'), 'Expenses::add');
        $routes->post(Hash::path('addAction'), 'Expenses::addAction');
    });
    $routes->group('customers/', static function ($routes) {
        $routes->get(Hash::path('view'), 'Login::view');
    });
    $routes->group('reports/', static function ($routes) {
        $routes->get(Hash::path('index') . '/(:any)', 'Reports::index/$1');
    });
});
$routes->get('logout', 'Login::logout');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
