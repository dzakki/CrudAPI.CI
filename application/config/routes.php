<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['api/articles']['GET'] = 'article/get_all';
$route['api/article/(:num)']['GET'] = 'article/get/$1';
$route['api/article/(:num)']['POST'] = 'article/update/$1';
$route['api/article/(:num)']['DELETE'] = 'article/delete/$1';
$route['api/article/i']['POST'] = 'article/create';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
