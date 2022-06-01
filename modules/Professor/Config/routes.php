<?php

$routes->group('professor', ['namespace' => 'Modules\Professor\Controllers', 'filter'=> 'isLoggedIn'], function($routes){


	$routes->get('/', 'ProfessorHome::index');
	$routes->get('manage', 'ProfessorHome::manage_research');
	$routes->match(['get', 'post'], 'profile', 'ProfessorHome::professor_profile');
	$routes->match(['get', 'post'], 'view_research/(:num)', 'ProfessorHome::view_research/$1');
	$routes->match(['get', 'post'], 'view_research2/(:num)', 'ProfessorHome::view_research2/$1');

	$routes->match(['get', 'post'], 'upload', 'ProfessorHome::upload_research');
	$routes->match(['get', 'post'], 'add_panel', 'ProfessorHome::addPanelist');
	$routes->match(['get', 'post'], 'add_panel_edit/(:num)', 'ProfessorHome::addPanelistEdit/$1');

	$routes->match(['get', 'post'], 'after_upload', 'ProfessorHome::after_upload');

	$routes->match(['get', 'post'], 'delete_prof_res/(:num)', 'ProfessorHome::delete_research/$1');
	$routes->match(['get', 'post'], 'edit_prof_res/(:num)', 'ProfessorHome::edit_research/$1');

	// $routes->match(['get', 'post'], 'edit_prof_res/(:num)', 'ProfessorHome::after_upload/$1delete_research');

	$routes->match(['get', 'post'], 'getStudentResearch', 'ResearchFilter::get_student_research');
	$routes->match(['get', 'post'], 'getProfResearch', 'ResearchFilter::get_professor_research');
	$routes->match(['get', 'post'], 'submitAgain/(:num)', 'ResearchFilter::submit_research_again/$1');

	$routes->match(['get', 'post'], 'infoSheet', 'ProfessorInfo::index');
	$routes->match(['get', 'post'], 'addSeminar/(:num)', 'ProfessorInfo::add_seminar/$1');
	$routes->match(['get', 'post'], 'addResearch/(:num)', 'ProfessorInfo::add_published_research/$1');
	$routes->match(['get', 'post'], 'delSeminar/(:num)', 'ProfessorInfo::delete_seminar/$1');
	$routes->match(['get', 'post'], 'delpResearch/(:num)', 'ProfessorInfo::delete_pResearch/$1');

	//For Faculty Details
	$routes->match(['get', 'post'], 'profSeminar', 'FacultyDetails::prof_seminar');
	$routes->match(['get', 'post'], 'profPubResearch', 'FacultyDetails::prof_published_research');

	$routes->match(['get', 'post'], 'profSeminarPdf', 'FacultyDetails::faculty_seminar_pdf');
	$routes->match(['get', 'post'], 'profpResearchPdf', 'FacultyDetails::faculty_pResearch_pdf');

	$routes->match(['get', 'post'], 'profSeminarCsv', 'FacultyDetails::faculty_seminar_csv');
	$routes->match(['get', 'post'], 'profpResearchCsv', 'FacultyDetails::faculty_pResearch_csv');

	$routes->match(['get', 'post'], 'searchProfSeminar', 'FacultyDetails::search_prof_seminar');
	$routes->match(['get', 'post'], 'searchPubResearch', 'FacultyDetails::search_pub_research');


});
