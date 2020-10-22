<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
*/
$route['default_controller'] = 'welcome';
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
| customer
| -------------------------------------------------------------------------
*/
$route['master/pelanggan']				= 'master/Customer';
$route['master/pelanggan/add']			= 'master/Customer/add';
$route['master/pelanggan/edit/(:any)']		= 'master/Customer/edit/$1';
$route['master/pelanggan/deleted/(:any)']	= 'master/Customer/deleted/$1';

/*
| -------------------------------------------------------------------------
| products
| -------------------------------------------------------------------------
*/
$route['master/produk']				= 'master/Product';
$route['master/produk/add']			= 'master/Product/add';
$route['master/produk/edit/(:any)']	= 'master/Product/edit/$1';
$route['master/produk/deleted/(:any)']	= 'master/Product/deleted/$1';
