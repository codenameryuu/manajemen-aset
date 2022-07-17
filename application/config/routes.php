<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Auth/LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// ============================================================================================
// Authentikasi
// ============================================================================================

$route['register'] = 'Auth/LoginController/register';
$route['authenticate'] = 'Auth/LoginController/authenticate';
$route['logout'] = 'Auth/LoginController/logout';


// ============================================================================================
// Home
// ============================================================================================

$route['home'] = 'Home/HomeController';

// ============================================================================================
// Akun
// ============================================================================================

$route['master-data/akun'] = 'MasterData/AkunController';
$route['master-data/akun/create'] = 'MasterData/AkunController/create';
$route['master-data/akun/store'] = 'MasterData/AkunController/store';
$route['master-data/akun/edit/(:any)'] = 'MasterData/AkunController/edit/$1';
$route['master-data/akun/update'] = 'MasterData/AkunController/update';
$route['master-data/akun/destroy'] = 'MasterData/AkunController/destroy';

// Ajax
$route['master-data/akun/cek-kode'] = 'MasterData/AkunController/cekKode';
$route['master-data/akun/cek-nama'] = 'MasterData/AkunController/cekNama';

// ============================================================================================
// Kategori
// ============================================================================================

$route['master-data/kategori'] = 'MasterData/KategoriController';
$route['master-data/kategori/create'] = 'MasterData/KategoriController/create';
$route['master-data/kategori/store'] = 'MasterData/KategoriController/store';
$route['master-data/kategori/edit/(:any)'] = 'MasterData/KategoriController/edit/$1';
$route['master-data/kategori/update'] = 'MasterData/KategoriController/update';
$route['master-data/kategori/destroy'] = 'MasterData/KategoriController/destroy';

// Ajax
$route['master-data/kategori/cek-kode'] = 'MasterData/KategoriController/cekKode';
$route['master-data/kategori/cek-nama'] = 'MasterData/KategoriController/cekNama';

// ============================================================================================
// Data Aset Aktif
// ============================================================================================

$route['data/data-aset/aktif'] = 'Data/AsetController';
$route['data/data-aset/aktif/show/(:any)'] = 'Data/AsetController/showAktif/$1';

$route['data/data-aset/tidak-aktif'] = 'Data/AsetController/tidakAktif';
$route['data/data-aset/tidak-aktif/show/(:any)'] = 'Data/AsetController/showTidakAktif/$1';

$route['data/data-aset/destroy'] = 'Data/AsetController/destroy';

// ============================================================================================
// Transaksi Perolehan
// ============================================================================================

$route['transaksi/perolehan'] = 'Transaksi/PerolehanController';
$route['transaksi/perolehan/create'] = 'Transaksi/PerolehanController/create';
$route['transaksi/perolehan/store'] = 'Transaksi/PerolehanController/store';
$route['transaksi/perolehan/show/(:any)'] = 'Transaksi/PerolehanController/show/$1';
$route['transaksi/perolehan/destroy'] = 'Transaksi/PerolehanController/destroy';

// ============================================================================================
// Transaksi Penyusutan
// ============================================================================================

$route['transaksi/penyusutan'] = 'Transaksi/PenyusutanController';
$route['transaksi/penyusutan/cari'] = 'Transaksi/PenyusutanController/search';
$route['transaksi/penyusutan/susutkan'] = 'Transaksi/PenyusutanController/susutkan';

// ============================================================================================
// Transaksi Perbaikan
// ============================================================================================

$route['transaksi/perbaikan'] = 'Transaksi/PerbaikanController';
$route['transaksi/perbaikan/create'] = 'Transaksi/PerbaikanController/create';
$route['transaksi/perbaikan/store'] = 'Transaksi/PerbaikanController/store';
$route['transaksi/perbaikan/show/(:any)'] = 'Transaksi/PerbaikanController/show/$1';
$route['transaksi/perbaikan/destroy'] = 'Transaksi/PerbaikanController/destroy';

// ============================================================================================
// Transaksi Pemberhentian
// ============================================================================================

$route['transaksi/pemberhentian'] = 'Transaksi/PemberhentianController';
$route['transaksi/pemberhentian/create'] = 'Transaksi/PemberhentianController/create';
$route['transaksi/pemberhentian/store'] = 'Transaksi/PemberhentianController/store';
$route['transaksi/pemberhentian/show/(:any)'] = 'Transaksi/PemberhentianController/show/$1';

// ============================================================================================
// Laporan Jurnal
// ============================================================================================

$route['laporan/jurnal'] = 'Laporan/JurnalController';

// ============================================================================================
// Laporan Buku Besar
// ============================================================================================

$route['laporan/buku-besar'] = 'Laporan/BukuBesarController';
$route['laporan/buku-besar/update-saldo-awal'] = 'Laporan/BukuBesarController/updateSaldoAwal';

// ============================================================================================
// Laporan Akhir Aset
// ============================================================================================

$route['laporan/laporan-akhir-aset'] = 'Laporan/LaporanAkhirController';
