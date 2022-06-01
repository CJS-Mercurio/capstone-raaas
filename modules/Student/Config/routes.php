<?php

$routes->group('student', ['namespace' => 'Modules\Student\Controllers', 'filter'=> 'isLoggedIn'], function($routes){


	$routes->get('/', 'StudentHome::index');
	$routes->match(['get', 'post'], 'profile', 'StudentHome::studentProfile');
	$routes->match(['get', 'post'], 'edit', 'StudentHome::edit');
	$routes->get('manage', 'StudentHome::manageResearch');
	$routes->match(['get', 'post'], 'upload', 'StudentHome::uploadResearch');
	$routes->match(['get', 'post'], 'fileUpload', 'StudentHome::fileUpload');
	$routes->match(['get', 'post'], 'fileEdit/(:num)', 'StudentHome::fileEditUpload/$1');
	$routes->match(['get', 'post'], 'addPanel', 'StudentHome::add_panelist');
	$routes->match(['get', 'post'], 'editAddPanel/(:num)', 'ResearchView::edit_add_panelist/$1');
	$routes->match(['get', 'post'], 'afterUpload', 'StudentHome::after_upload');


	$routes->match(['get', 'post'], 'viewResearch/(:num)', 'StudentHome::view_research/$1');
	$routes->match(['get', 'post'], 'view_research/(:num)', 'ResearchView::view_research/$1');
	$routes->match(['get', 'post'], 'deleteResearch/(:num)', 'ResearchView::delete_research/$1');
	$routes->match(['get', 'post'], 'editResearch/(:num)', 'ResearchView::edit_research/$1');
	$routes->match(['get', 'post'], 'getStudentResearch', 'ResearchView::get_student_research');
	$routes->match(['get', 'post'], 'getProfResearch', 'ResearchView::get_professor_research');


	$routes->match(['get', 'post'], 'voucher/(:num)', 'ResearchView::download_research_voucher/$1');
	$routes->match(['get', 'post'], 'submitAgain/(:num)', 'ResearchView::submit_research_again/$1');

	$routes->match(['get', 'post'], 'pdfResearch/(:num)', 'Voucher::index/$1');
	$routes->match(['get', 'post'], 'download/(:alphanum)', 'ResearchView::download_research_softcopy/$1');


//For Information Sheet 
	$routes->match(['get', 'post'], 'infoSheet', 'StudentInfo::index');
	$routes->match(['get', 'post'], 'addSeminar/(:num)', 'StudentInfo::add_seminar/$1');
	$routes->match(['get', 'post'], 'delSeminar/(:num)', 'StudentInfo::delete_seminar/$1');


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

// $routes->group('', ['filter'=> 'isLoggedIn'], function($routes){


// 	$routes->get('/', 'StudentHome::index');
// 	$routes->get('profile', 'StudentHome::studentProfile');
// 	$routes->get('edit', 'StudentHome::edit');
// });
