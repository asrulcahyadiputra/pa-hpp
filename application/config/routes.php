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
