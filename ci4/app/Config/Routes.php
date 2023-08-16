<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/obat/upload', 'web\Obat::upload');

//$routes->resource('api/post', ['controller' =>'Post']);
$routes->resource('api/jenis', ['controller' =>'Jenis']);
$routes->resource('api/pengguna', ['controller' =>'Pengguna']);
$routes->resource('api/pelanggan', ['controller' =>'Pelanggan']);
$routes->resource('api/supplier', ['controller' =>'Supplier']);
$routes->resource('api/obat', ['controller' =>'Obat']);
$routes->resource('api/pembelian', ['controller' =>'Pembelian']);
$routes->resource('api/penjualan', ['controller' =>'Penjualan']);
$routes->resource('api/item_pembelian', ['controller' =>'ItemPembelian']);
$routes->resource('api/item_penjualan', ['controller' =>'ItemPenjualan']);

$routes->get('/dashboard', 'web\Dashboard::index');
$routes->get('/kategori', 'web\Kategori::index');
$routes->get('/satuan', 'web\Satuan::index');
$routes->get('/users', 'web\Users::index');
$routes->get('/pelanggan', 'web\Pelanggan::index');
$routes->get('/supplier', 'web\Supplier::index');
$routes->get('/obat', 'web\Obat::index');
$routes->get('/pembelian', 'web\Pembelian::index');
$routes->get('/penjualan', 'web\Penjualan::index');

//hapus
$routes->get('/kategori/hapus/(:num)', 'web\Kategori::hapus/$1');
$routes->get('/satuan/hapus/(:num)', 'web\Satuan::hapus/$1');
$routes->get('/users/hapus/(:num)', 'web\Users::hapus/$1');
$routes->get('/pelanggan/hapus/(:num)', 'web\Pelanggan::hapus/$1');
$routes->get('/supplier/hapus/(:num)', 'web\Supplier::hapus/$1');
$routes->get('/obat/hapus/(:num)', 'web\Obat::hapus/$1');

//tambah
$routes->post('/kategori/tambah', 'web\Kategori::tambah');
$routes->post('/satuan/tambah', 'web\Satuan::tambah');
$routes->post('/users/tambah', 'web\Users::tambah');
$routes->post('/pelanggan/tambah', 'web\Pelanggan::tambah');
$routes->post('/supplier/tambah', 'web\Supplier::tambah');
$routes->post('/obat/tambah', 'web\Obat::tambah');

//edit
$routes->post('/kategori/edit', 'web\Kategori::edit');
$routes->post('/satuan/edit', 'web\Satuan::edit');
$routes->post('/users/edit', 'web\Users::edit');
$routes->post('/pelanggan/edit', 'web\Pelanggan::edit');
$routes->post('/supplier/edit', 'web\Supplier::edit');
$routes->post('/obat/edit', 'web\Obat::edit');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
