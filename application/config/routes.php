<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	$route['default_controller'] = 'Employees/login'; 
	// $route['login'] = 'Employees/login'; #loging in process
	$route['login'] = 'AuthController/login'; #loging in process
	// $route['login/error'] = 'Employees/login'; #loging in process
	$route['signup'] = 'Employees';
	$route['create'] = 'Employees/create';#signup process
	$route['home'] = 'Employees/homeMethod';# logged in process
	$route['logout'] = 'Employees/logout';# logged in process
	$route['404_override'] = '';
	$route['translate_uri_dashes'] = FALSE;
?>
