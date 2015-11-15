<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "index";
$route['404_override'] = '';

$route['admin/error/(:num)'] = 'admin/error/index/$1';

$route['(:any).html'] = 'show/index/$1.html';

$route['admin'] = 'admin/login';
$route['admin/news/(:num)/(:any)'] = 'admin/news/index/$1/$2';
$route['admin/news/(:num)/(:any)/(:num)'] = 'admin/news/index/$1/$2/$3';
$route['admin/product/(:num)'] = 'admin/product/index/$1';
$route['admin/product/(:num)/(:num)'] = 'admin/product/index/$1/$2';
$route['admin/financing/create'] = 'admin/financing/create';
$route['admin/financing/do_create'] = 'admin/financing/do_create';
$route['admin/financing/(:any)'] = 'admin/financing/index/$1';
$route['admin/financing/(:any)/(:num)'] = 'admin/financing/index/$1/$2';
$route['admin/user/create'] = 'admin/user/create';
$route['admin/user/do_create'] = 'admin/user/do_create';
$route['admin/user/(:any)'] = 'admin/user/index/$1';
$route['admin/user/(:any)/(:num)'] = 'admin/user/index/$1/$2';

/* End of file routes.php */
/* Location: ./application/config/routes.php */