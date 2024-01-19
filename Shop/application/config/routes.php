<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'Main';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//login & register
$route['register'] = 'Auth/register';
$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';


//list of products
$route['roupa'] = 'roupa';
$route['roupa/(:num)'] = 'product/view/$1';

//cart
$route['cart/view'] = 'cart/cartView';
$route['cart/add'] = 'cart/add';
$route['cart/clear'] = 'Cart/clear';
$route['cart/count'] = 'cart/count';
$route['cart/update_quantity'] = 'cart/update_quantity';
$route['local'] = 'cart/local';
$route['cart/pagar'] = 'cart/pagar';
$route['cart/completePayment'] = 'cart/completePayment';
$route['cart/removeProduct/(:any)'] = 'Cart/removeProduct/$1';


//control users
$route['admin/users'] = 'Admin/index';
$route['admin/ban_user/(:num)'] = 'Admin/ban_user/$1';
$route['admin/assign_role_seller/(:num)'] = 'admin/assign_role_seller/$1';
$route['admin/remove_role_seller/(:num)'] = 'admin/remove_role_seller/$1';


//control products
$route['products/add'] = 'products/add';
$route['products/edit/(:num)'] = 'products/edit/$1';
$route['products/delete/(:num)'] = 'products/delete/$1';
$route['products/delete-all'] = 'products/delete_all';

//add location
$route['address'] = 'AddressController/addressForm';
$route['address/saveAddress'] = 'AddressController/saveAddress';
$route['address/success'] = 'AddressController/success';




