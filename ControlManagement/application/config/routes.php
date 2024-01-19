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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//log and reg | logout
$route['register'] = 'register';
$route['register/process_registration'] = 'register/process_registration';
$route['logout'] = 'login/logout';

//main
$route['projects'] = 'ProjectController/index';
$route['projects/(:num)'] = 'ProjectController/index/$1';
$route['join_project/(:num)'] = 'ProjectDetailsController/joinProject/$1';

//roles 
$route['role'] = 'RoleController/index';
$route['increaseRole/(:num)'] = 'RoleController/increaseRole/$1';
$route['removeRole/(:num)'] = 'RoleController/removeRole/$1';
$route['role/(:num)'] = 'RoleController/index/$1';


//create project 
$route['create_project'] = 'CreateProjectController/index';
$route['create_project/create'] = 'CreateProjectController/create';

//detail project
$route['project_details/show/(:num)'] = 'ProjectDetailsController/index/$1';
$route['project_details/delete/(:num)'] = 'ProjectDetailsController/deleteProject/$1';
$route['project_details/update_allocation'] = 'ProjectDetailsController/update_allocation';

//report project 
$route['project_reports'] = 'ReportsController/projectReports';
$route['person_reports'] = 'ReportsController/personReports';
$route['project-reports/(:num)'] = 'ReportsController/projectReports/$1';
$route['person-reports/(:num)'] = 'ReportsController/personReports/$1';

//invite
$route['invite/(:num)'] = 'InviteController/index/$1';
$route['invite/sendInvitation/(:num)/(:num)'] = 'InviteController/sendInvitation/$1/$2';
$route['invite/index/(:num)/(:num)'] = 'invite/index/$1/$2';





