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

$route['default_controller'] = "home";
//$route['default_controller'] = "admin/index";
$route['404_override'] = '';

//$route['admin/(:any)'] = "admin/index/$1";
$route['admin'] = "admin/index";
$route['contact'] = "index/contact";
$route['hotel-details/(:num)/(:any)'] = "hotelsummaries/hotel_info_details/$1/$2";
$route['Destinations'] = "home/destinations";
$route['login'] = 'c_login';
$route['login/login_check'] = 'user/login_check';
$route['signup/signup_check'] = 'user/signup_check';
$route['user/my_account_update'] = 'user/my_account_update';

$route['how_it_works'] = "home/how_it_works";
$route['about_us'] = "home/about_us";
$route['terms_conditions'] = "home/terms_conditions";
$route['privacy'] = "home/privacy";
$route['faq'] = "home/faq";
/* End of file routes.php */
/* Location: ./application/config/routes.php */