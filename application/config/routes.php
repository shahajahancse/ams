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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['404_override'] = 'site/not_found';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8

// $route['guest_test'] 	= 'my_profile/guest_test';
// $route['scout-application-request'] 	= 'my_profile/scout_request_application';
// $route['scout-application-update'] 		= 'my_profile/scout_request_application_update';
// $route['my-submitted-information'] 		= 'my_profile/submited_info';

// $route['institute'] 		= 'api/appusers/institute';
// $route['scoutlist'] 		= 'api/appusers/scoutlist';

//backend
// $route['logout'] = 'adminlogin/logout';
$route['forgot-password'] = 'forgot_password';

// portal
// $route['login'] 			= 'site/login';
$route['activate/(:num)/(:any)'] = 'site/activate/$1/$2';
$route['registration'] 	= 'site/registration';
$route['logout'] 			= 'site/logout';
$route['my-account'] 	= 'site/my_account';
$route['my-appointment'] 	= 'site/my_appointment';
$route['create-appointment'] 	= 'site/create_appointment';
$route['appointment-details/(:any)'] 	= 'site/appointment_details/$1';
$route['pass-queue']   = 'site/pass_queue';



// $route['switchlang/(:any)']		= 'site/switchlang/$1';
// $route['scout-news-details/(:num)'] = 'site/scout_news_details/$1';
// $route['scout-group-application'] 				= 'site/scout_group_application';
// $route['success-scout-application/(:any)']	= 'site/success_scout_application/$1';
// $route['scout-application-pdf/(:any)'] 		= 'site/scout_application_pdf/$1';

// $route['scout-news'] 			= 'site/scout_news';
// $route['scout-event-details/(:num)'] = 'site/scout_event_details/$1';
// $route['scout-events'] 			= 'site/scout_events';
// $route['not-found'] 				= 'site/not_found';
// $route['faqs'] 					= 'site/faqs';
// $route['user-manual'] 			= 'site/user_manual';
// $route['organogram'] 			= 'site/organogram';
// $route['contact'] 			= 'site/contact';
// $route['national-committee'] 	= 'site/national_committee';
// $route['scout-department'] 	= 'site/scout_department';
// $route['index'] 				= 'site/index';
// $route['region'] 				= 'site/region';
// $route['district'] 			= 'site/district';
// $route['district/(:any)']	= 'site/district/$1';
// $route['upazila']				= 'site/upazila';
// $route['upazila/(:any)']	= 'site/upazila/$1';
// $route['groups']				= 'site/groups';
// $route['groups/(:any)']		= 'site/groups/$1';
// $route['unit']					= 'site/unit';
// $route['unit/(:any)']		= 'site/unit/$1';
// $route['complain'] 			= 'site/complain';
// $route['search'] 				= 'site/search';
// $route['success'] 			= 'site/success';
// $route['service'] 			= 'site/service';
// $route['service-traking'] 	= 'site/service_traking';
// $route['user-verify'] 		= 'site/user_verify';
// $route['user/(:any)'] 		= 'site/user/$1';
// $route['official-id/(:any)'] 			= 'site/official_id/$1';
// $route['services-request/(:any)'] 	= 'site/services_request/$1';
// $route['blood-donation/(:any)'] 		= 'site/blood_donation/$1';
// $route['region-details/(:any)'] 		= 'site/region_details/$1';
// $route['district-details/(:any)'] 	= 'site/district_details/$1';
// $route['upazila-details/(:any)'] 	= 'site/upazila_details/$1';
// $route['group-details/(:any)'] 		= 'site/group_details/$1';
// $route['unit-details/(:any)'] 		= 'site/unit_details/$1';
// $route['registration-now/(:any)'] = 'site/registration_now/$1';

//Cropper
$route['avatar-upload'] = "common/upload";