<?php

$routes->group('superadmin', ['namespace' => 'Modules\SuperAdmin\Controllers', 'filter'=> 'isLoggedIn'], function($routes){


	$routes->get('/', 'SuperAdminHome::index');
	$routes->match(['get','post'], 'department', 'SuperAdminHome::config_department');
	$routes->match(['get','post'], 'addDepartment', 'SuperAdminHome::add_department');
	$routes->match(['get','post'], 'deactDepartment/(:num)', 'SuperAdminHome::deact_department/$1');
	$routes->match(['get','post'], 'actDepartment/(:num)', 'SuperAdminHome::act_department/$1');

	$routes->match(['get','post'], 'role', 'SuperAdminHome::config_role');
	$routes->match(['get','post'], 'addRole', 'SuperAdminHome::add_role');
	$routes->match(['get','post'], 'deactRole/(:num)', 'SuperAdminHome::deact_role/$1');
	$routes->match(['get','post'], 'actRole/(:num)', 'SuperAdminHome::act_role/$1');


	$routes->match(['get','post'], 'permission', 'SuperAdminHome::config_permission');
	$routes->match(['get','post'], 'editPermission', 'SuperAdminHome::edit_permission');


	$routes->match(['get','post'], 'module', 'SuperAdminHome::config_module');
	$routes->match(['get','post'], 'addModule', 'SuperAdminHome::add_module');
	$routes->match(['get','post'], 'deactModule/(:num)', 'SuperAdminHome::deact_module/$1');
	$routes->match(['get','post'], 'actModule/(:num)', 'SuperAdminHome::act_module/$1');
	$routes->match(['get','post'], 'editModule/(:num)', 'SuperAdminHome::edit_module/$1');


	$routes->match(['get','post'], 'addFunc/(:num)', 'SuperAdminHome::add_function/$1');
	$routes->match(['get','post'], 'deactFunction/(:num)/(:num)', 'SuperAdminHome::deact_function/$1/$2');
	$routes->match(['get','post'], 'actFunction/(:num)/(:num)', 'SuperAdminHome::act_function/$1/$2');

	$routes->match(['get','post'], 'archive', 'SuperAdminHome::config_archive');

	$routes->get('userAccount', 'SuperAdminUser::index');
	$routes->match(['get','post'], 'deactUser/(:num)', 'SuperAdminUser::deact_user/$1');
	$routes->match(['get','post'], 'actUser/(:num)', 'SuperAdminUser::act_user/$1');
	$routes->match(['get','post'], 'viewUser/(:num)', 'SuperAdminUser::view_user/$1');
	$routes->match(['get','post'], 'addUser', 'SuperAdminUser::add_user');
	$routes->match(['get','post'], 'addStudentUser/(:num)', 'SuperAdminUser::add_student_user/$1');
	$routes->match(['get','post'], 'addFacultyUser/(:num)', 'SuperAdminUser::add_faculty_user/$1');



	$routes->get('form', 'SuperAdminForm::index');
	$routes->match(['get','post'], 'addGender', 'SuperAdminForm::add_gender');
	$routes->match(['get','post'], 'deactGender/(:num)', 'SuperAdminForm::deact_gender/$1');
	$routes->match(['get','post'], 'actGender/(:num)', 'SuperAdminForm::act_gender/$1');

	$routes->match(['get','post'], 'addYear', 'SuperAdminForm::add_year');
	$routes->match(['get','post'], 'deactYear/(:num)', 'SuperAdminForm::deact_year/$1');
	$routes->match(['get','post'], 'actYear/(:num)', 'SuperAdminForm::act_year/$1');

	$routes->match(['get','post'], 'addAcadStatus', 'SuperAdminForm::add_acad_status');
	$routes->match(['get','post'], 'deactAcadStatus/(:num)', 'SuperAdminForm::deact_acad_status/$1');
	$routes->match(['get','post'], 'actAcadStatus/(:num)', 'SuperAdminForm::act_acad_status/$1');

	$routes->match(['get','post'], 'addStatus', 'SuperAdminForm::add_status');
	$routes->match(['get','post'], 'deactStatus/(:num)', 'SuperAdminForm::deact_status/$1');
	$routes->match(['get','post'], 'actStatus/(:num)', 'SuperAdminForm::act_status/$1');

	$routes->match(['get','post'], 'addPaperType', 'SuperAdminForm::add_paper_type');
	$routes->match(['get','post'], 'deactPaperType/(:num)', 'SuperAdminForm::deact_paper_type/$1');
	$routes->match(['get','post'], 'actPaperType/(:num)', 'SuperAdminForm::act_paper_type/$1');

	$routes->match(['get','post'], 'addSetting', 'SuperAdminForm::add_setting');
	$routes->match(['get','post'], 'deactSetting/(:num)', 'SuperAdminForm::deact_setting/$1');
	$routes->match(['get','post'], 'actSetting/(:num)', 'SuperAdminForm::act_setting/$1');

	$routes->match(['get','post'], 'addForumReason', 'SuperAdminForm::add_forum_reason');
	$routes->match(['get','post'], 'deactForumReason/(:num)', 'SuperAdminForm::deact_forum_reason/$1');
	$routes->match(['get','post'], 'actForumReason/(:num)', 'SuperAdminForm::act_forum_reason/$1');

	$routes->match(['get','post'], 'addAdviserReason', 'SuperAdminForm::add_adviser_reason');
	$routes->match(['get','post'], 'deactAdviserReason/(:num)', 'SuperAdminForm::deact_adviser_reason/$1');
	$routes->match(['get','post'], 'actAdviserReason/(:num)', 'SuperAdminForm::act_adviser_reason/$1');

	$routes->match(['get','post'], 'addAdminReason', 'SuperAdminForm::add_admin_reason');
	$routes->match(['get','post'], 'deactAdminReason/(:num)', 'SuperAdminForm::deact_admin_reason/$1');
	$routes->match(['get','post'], 'actAdminReason/(:num)', 'SuperAdminForm::act_admin_reason/$1');

	$routes->match(['get','post'], 'addEventType', 'SuperAdminForm::add_event_type');
	$routes->match(['get','post'], 'deactEventType/(:num)', 'SuperAdminForm::deact_event_type/$1');
	$routes->match(['get','post'], 'actEventType/(:num)', 'SuperAdminForm::act_event_type/$1');

	$routes->match(['get','post'], 'addCategory', 'SuperAdminForm::add_category');
	$routes->match(['get','post'], 'deactCategory/(:num)', 'SuperAdminForm::deact_category/$1');
	$routes->match(['get','post'], 'actCategory/(:num)', 'SuperAdminForm::act_category/$1');

	//user accounts
	$routes->get('students', 'Students::index');
	$routes->post('students/insert-spreadsheet', 'Students::insertSpreadsheet');
	$routes->match(['get', 'post'], 'students/add', 'Students::add');
	// $routes->match(['get', 'post'], 'edit/(:num)', 'Students::edit/$1');
	// $routes->get('delete/(:num)', 'Students::delete/$1');

	$routes->get('professors', 'Professors::index');
	$routes->post('professors/insert-spreadsheet', 'Professors::insertSpreadsheet');
	$routes->match(['get', 'post'], 'professors/add', 'Professors::add');

});
