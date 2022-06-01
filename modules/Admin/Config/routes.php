<?php

$routes->group('admin', ['namespace' => 'Modules\Admin\Controllers', 'filter'=> 'isLoggedIn'], function($routes){


	// $routes->get('/', 'AdminHome::index');
	// $routes->get('config', 'AdminHome::configure');
	// $routes->match(['get','post'], 'addCourse', 'AdminCourseConfig::addCourse');
	// $routes->get('users-list', 'DataTableController::index');

	$routes->get('/', 'AdminHome::index');
	$routes->get('config', 'AdminConfigure::index');
	$routes->get('reports', 'AdminReports::index');
	$routes->get('fetch_all', 'AdminHome::fetch_all');
	$routes->match(['get','post'], 'pending', 'AdminHome::pending_researches');

	$routes->match(['get','post'], 'addCourse', 'AdminConfigure::add_course');
	$routes->match(['get','post'], 'addFaculty', 'AdminConfigure::add_faculty');
	$routes->match(['get','post'], 'delFaculty/(:num)', 'AdminConfigure::delete_faculty/$1');
	$routes->match(['get','post'], 'delCourse/(:num)', 'AdminConfigure::delete_course/$1');
	$routes->match(['get','post'], 'setSY', 'AdminConfigure::set_school_year');
	$routes->match(['get','post'], 'setDir', 'AdminConfigure::set_director');
	$routes->match(['get','post'], 'userRequest', 'AdminConfigure::user_pending_request');

	$routes->match(['get','post'], 'studRegistration/(:num)', 'AdminConfigure::student_register_request/$1');
	$routes->match(['get','post'], 'studRegister/(:num)', 'AdminConfigure::s_register_request/$1');
	$routes->match(['get','post'], 'profRegistration/(:num)', 'AdminConfigure::prof_register_request/$1');
	$routes->match(['get','post'], 'userRegistration/(:num)', 'AdminConfigure::user_register_request/$1');
	$routes->match(['get','post'], 'profRegister/(:num)', 'AdminConfigure::p_register_request/$1');
	$routes->match(['get','post'], 'unactivated', 'AdminConfigure::unactivated_account');


	$routes->match(['get','post'], 'studActivate/(:num)', 'AdminConfigure::student_activate_account/$1');
	$routes->match(['get','post'], 'profActivate/(:num)', 'AdminConfigure::professor_activate_account/$1');
	$routes->match(['get','post'], 'userActivate/(:num)', 'AdminConfigure::user_activate_account/$1');


	$routes->match(['get','post'], 'studDeactivate/(:num)', 'AdminConfigure::student_deactivate_account/$1');
	$routes->match(['get','post'], 'profDeactivate/(:num)', 'AdminConfigure::professor_deactivate_account/$1');
	$routes->match(['get','post'], 'userDeactivate/(:num)', 'AdminConfigure::user_deactivate_account/$1');

	$routes->match(['get','post'], 'activateConfirm/(:alphanum)', 'AdminConfigure::activation_confirm/$1');

	$routes->match(['get','post'], 'delStudentExpAcc/(:num)', 'AdminConfigure::delete_student_expired_account/$1');
	$routes->match(['get','post'], 'delProfExpAcc/(:num)', 'AdminConfigure::delete_prof_expired_account/$1');
	$routes->match(['get','post'], 'delUserExpAcc/(:num)', 'AdminConfigure::delete_user_expired_account/$1');



	$routes->match(['get','post'], 'viewResearch/(:num)', 'AdminResearchView::view_research/$1');
	$routes->match(['get','post'], 'approveResearch/(:num)', 'AdminResearchView::approve_research/$1');
	$routes->match(['get','post'], 'disapproveResearch/(:num)', 'AdminResearchView::disapprove_research/$1');

	$routes->match(['get','post'], 'deleteCourse/(:num)', 'AdminCourseConfig::delete_course/$1');
	$routes->match(['get','post'], 'deleteFaculty/(:num)', 'AdminFacultyConfig::delete_faculty/$1');
	$routes->match(['get','post'], 'deactFaculty/(:num)', 'AdminConfigure::deact_faculty/$1');
	$routes->match(['get','post'], 'actFaculty/(:num)', 'AdminConfigure::act_faculty/$1');

	$routes->match(['get', 'post'], 'getStudentResearch', 'AdminHome::get_student_research');
	$routes->match(['get', 'post'], 'getProfResearch', 'AdminHome::get_professor_research');


	$routes->match(['get', 'post'], 'profSeminar', 'AdminReports::prof_seminar');
	$routes->match(['get', 'post'], 'profPubResearch', 'AdminReports::prof_published_research');
	$routes->match(['get', 'post'], 'studentSeminar', 'AdminReports::all_student_seminar');
	$routes->match(['get', 'post'], 'perStudentSeminar', 'AdminReports::per_student_seminar');

	//reports
	$routes->match(['get', 'post'], 'reportByCourse', 'AdminReports::report_by_course');
	$routes->match(['get', 'post'], 'reportDashboard', 'AdminReports::report_dashboard');

	$routes->match(['get', 'post'], 'reportAllCoursePdf/(:num)/(:num)/(:num)', 'AdminReports::report_all_course_pdf/$1/$2/$3');
	$routes->match(['get', 'post'], 'reportByCoursePdf/(:num)/(:num)/(:num)', 'AdminReports::report_by_course_pdf/$1/$2/$3');

	$routes->match(['get', 'post'], 'reports/perYearGraph', 'AdminReports::per_year_graph');
	$routes->match(['get', 'post'], 'reports/perCourseGraph', 'AdminReports::per_course_graph');
	$routes->match(['get', 'post'], 'reports/perAdviserGraph', 'AdminReports::per_adviser_graph');


	$routes->match(['get', 'post'], 'studSeminarPdf', 'AdminReports::student_seminar_pdf');
	$routes->match(['get', 'post'], 'profSeminarPdf', 'AdminReports::faculty_seminar_pdf');
	$routes->match(['get', 'post'], 'profpResearchPdf', 'AdminReports::faculty_pResearch_pdf');

	$routes->match(['get', 'post'], 'studSeminarCsv', 'AdminReports::student_seminar_csv');
	$routes->match(['get', 'post'], 'profSeminarCsv', 'AdminReports::faculty_seminar_csv');
	$routes->match(['get', 'post'], 'profpResearchCsv', 'AdminReports::faculty_pResearch_csv');
	$routes->match(['get', 'post'], 'reportAllCourseCsv/(:num)/(:num)', 'AdminReports::research_allCourse_csv/$1/$2');
	$routes->match(['get', 'post'], 'reportPerCourseCsv/(:num)/(:num)/(:num)', 'AdminReports::research_perCourse_csv/$1/$2/$3');



});
