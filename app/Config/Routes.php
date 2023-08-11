<?php

namespace Config;

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
$routes->get('/', 'User::index');
$routes->get('/produk/info/(:num)', 'User::detail_produk/$1', ['filter' => 'role:user']);
$routes->get('/keranjang', 'User::keranjang_belanja', ['filter' => 'role:user']);
$routes->add('/keranjang/(:segment)', 'User::keranjang_edit_quantity/$1', ['filter' => 'role:user']);
$routes->get('/keranjang/(:segment)/delete', 'User::keranjang_delete/$1', ['filter' => 'role:user']);
$routes->add('/masukan_keranjang/(:num)', 'User::masukan_keranjang/$1', ['filter' => 'role:user']);
$routes->add('/transaksi_proses', 'User::proses_checkout', ['filter' => 'role:user']);
$routes->get('/orders', 'User::orders_index', ['filter' => 'role:user']);
$routes->get('/data_pembeli', 'User::data_pembeli', ['filter' => 'role:user']);
$routes->get('/tentang-kami', 'User::tentang_kami', ['filter' => 'role:user']);


$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/products_list', 'Admin::products_list', ['filter' => 'role:admin']);
$routes->add('/admin/tambah_produk', 'Admin::tambah_produk', ['filter' => 'role:admin']);
$routes->add('/admin/edit_produk/(:segment)', 'Admin::edit_produk/$1', ['filter' => 'role:admin']);
$routes->get('/admin/produk/(:segment)/delete', 'Admin::delete_produk/$1', ['filter' => 'role:admin']);
$routes->get('/admin/orders_list', 'Admin::order_list', ['filter' => 'role:admin']);
$routes->add('/admin/ubah_status_pesanan/(:segment)', 'Admin::ubah_status_pesanan/$1', ['filter' => 'role:admin']);
$routes->get('/admin/orders_list/(:segment)/delete', 'Admin::orders_delete/$1', ['filter' => 'role:admin']);
$routes->get('/invoice/(:segment)', 'User::invoice/$1');
$routes->get('/admin/laporan', 'Admin::laporan', ['filter' => 'role:admin']);
$routes->get('/admin/tentang-kami', 'Admin::tentangKami', ['filter' => 'role:admin']);
$routes->post('/admin/tentang-kami', 'Admin::updateTentangKami', ['filter' => 'role:admin']);
$routes->add('/admin/laporan_filter_tanggal', 'Admin::laporan_filter_tanggal', ['filter' => 'role:admin']);


$routes->get('/admin/manageuser', 'Admin::manageuser', ['filter' => 'role:admin']);
$routes->get('/admin/(:num)', 'Admin::users_detail/$1', ['filter' => 'role:admin']);

$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/lupa-password', 'Home::lupapass');
$routes->post('/lupa', 'Home::reset_password');
$routes->get('/reset-password/(:segment)', 'Home::password_reset/$1');
$routes->post('/reset-password/(:segment)', 'Home::password_reset/$1');
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