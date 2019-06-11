<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['api/articles']['GET'] = 'article/get_all';
$route['api/article/(:num)']['GET'] = 'article/get/$1';

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
