<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/
$route['default_controller'] = 'Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

##########################################################################
# 						-MAIN ROUTING- 					   #
##########################################################################
$route['Dasboard']					= 'Dashboard';





##########################################################################
# 						-DATA MASTER- 					   	   #
##########################################################################

/*
| -------------------------------------------------------------------------
| customer master
| -------------------------------------------------------------------------
*/
$route['master/pelanggan']				= 'master/Customer';
$route['master/pelanggan/add']			= 'master/Customer/add';
$route['master/pelanggan/edit/(:any)']		= 'master/Customer/edit/$1';
$route['master/pelanggan/deleted/(:any)']	= 'master/Customer/deleted/$1';

/*
| -------------------------------------------------------------------------
| products master
| -------------------------------------------------------------------------
*/
$route['master/produk']				= 'master/Product';
$route['master/produk/add']			= 'master/Product/add';
$route['master/produk/edit/(:any)']	= 'master/Product/edit/$1';
$route['master/produk/deleted/(:any)']	= 'master/Product/deleted/$1';

/*
| -------------------------------------------------------------------------
| materials master
| -------------------------------------------------------------------------
*/
$route['master/bahan_baku']				= 'master/Material';
$route['master/bahan_baku/add']			= 'master/Material/add';
$route['master/bahan_baku/edit/(:any)']		= 'master/Material/edit/$1';
$route['master/bahan_baku/deleted/(:any)']	= 'master/Material/deleted/$1';

/*
| -------------------------------------------------------------------------
| materials master
| -------------------------------------------------------------------------
*/
$route['master/karyawan']				= 'master/Employee';
$route['master/karyawan/add']				= 'master/Employee/add';
$route['master/karyawan/edit/(:any)']		= 'master/Employee/edit/$1';
$route['master/karyawan/deleted/(:any)']	= 'master/Employee/deleted/$1';

/*
| -------------------------------------------------------------------------
| materials master
| -------------------------------------------------------------------------
*/
$route['master/coa']					= 'master/Coa';
$route['master/coa/add']					= 'master/Coa/add';
$route['master/coa/update/(:any)']			= 'master/Coa/update/$1';
##########################################################################
# 						-Transactions- 					   #
##########################################################################

/*
| -------------------------------------------------------------------------
| Bill of
| -------------------------------------------------------------------------
*/
$route['transaksi/bom']							= 'transactions/Bom';
$route['transaksi/bom/draf']						= 'transactions/Bom/create_draff';
$route['transaksi/bom/create/(:any)']				= 'transactions/Bom/create/$1';
$route['transaksi/bom/store/(:any)']				= 'transactions/Bom/store/$1';
$route['transaksi/bom/update/(:any)']				= 'transactions/Bom/update/$1';
$route['transaksi/bom/delete/(:any)']				= 'transactions/Bom/destroy/$1';
$route['transaksi/bom/show/(:any)']				= 'transactions/Bom/show/$1';
$route['transaksi/bom/find_material']				= 'transactions/Bom/find_material';
$route['transaksi/bom/store_item']					= 'transactions/Bom/store_item';
$route['transaksi/bom/delete_item/(:any)/(:any)']		= 'transactions/Bom/delete_item/$1/$2';

/*
| -------------------------------------------------------------------------
| Sales order
| -------------------------------------------------------------------------
*/
$route['transaksi/pesanan']						= 'transactions/Order';
$route['transaksi/order/find_product']				= 'transactions/Order/find_product';
$route['transaksi/pesanan/add']					= 'transactions/Order/add';
$route['transaksi/pesanan/delete/(:any)']			= 'transactions/Order/delete/$1';

/*
| -------------------------------------------------------------------------
| Purchasing
| -------------------------------------------------------------------------
*/
$route['transaksi/pembelian']								= 'transactions/Purchase';
$route['transaksi/pembelian/create_draff']					= 'transactions/Purchase/create_draff';
$route['transaksi/pembelian/draff/(:any)']					= 'transactions/Purchase/create/$1';
$route['transaksi/pembelian/add_item']						= 'transactions/Purchase/add_item';
$route['transaksi/pembelian/delete_item/(:any)/(:any)']		= 'transactions/Purchase/delete_item/$1/$2';
$route['transaksi/pembelian/store/(:any)/(:any)/(:any)/(:any)']	= 'transactions/Purchase/store/$1/$2/$3/$4';

/*
| -------------------------------------------------------------------------
| Produksi
| -------------------------------------------------------------------------
*/
$route['transaksi/produksi']								= 'transactions/Production';
$route['transaksi/produksi/create']						= 'transactions/Production/create';
$route['transaksi/produksi/konversi/(:any)']					= 'transactions/Production/conversion/$1';
$route['transaksi/produksi/production_step/(:any)']			= 'transactions/Production/production_step/$1';
$route['store/btkl']									= 'transactions/Production/store_btkl';
$route['delete/btkl/(:any)/(:any)']						= 'transactions/Production/delete_btkl/$1/$2';
$route['done/btkl/(:any)/(:any)']							= 'transactions/Production/done_btkl/$1/$2';
$route['store/bop']										= 'transactions/Production/store_bop';
$route['delete/bop/(:any)/(:any)']							= 'transactions/Production/delete_bop/$1/$2';
$route['done/bop/(:any)/(:any)']							= 'transactions/Production/done_bop/$1/$2';
$route['transaksi/produksi/selesai/(:any)']					= 'transactions/Production/done_production/$1';


##########################################################################
# 						-Reports- 					   	   #
##########################################################################

/*
| -------------------------------------------------------------------------
| General Ledger
| -------------------------------------------------------------------------
*/
$route['laporan/jurnal']									= 'reports/General_ledger';

/*
| -------------------------------------------------------------------------
| Ledger
| -------------------------------------------------------------------------
*/
$route['laporan/buku_besar']								= 'reports/Ledger';
