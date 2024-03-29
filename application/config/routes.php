<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// users
$route['api/users']['GET'] = 'user/get_all';
$route['api/user/(:num)']['GET'] = 'user/get/$1';
$route['api/user/(:num)']['POST'] = 'user/update/$1';
$route['api/user/i']['POST'] = 'user/create';

// auth
$route['api/login']['POST'] = 'auth/login';
$route['api/check_token']['GET'] = 'auth/check_token';
$route['api/auth/(:num)']['DELETE'] = 'auth/delete/$1';

// articles
$route['api/articles']['GET'] = 'article/get_all';
$route['api/article/(:num)']['GET'] = 'article/get/$1';
$route['api/article/(:num)']['POST'] = 'article/update/$1';
$route['api/article/(:num)']['DELETE'] = 'article/delete/$1';
$route['api/article/i']['POST'] = 'article/create';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
