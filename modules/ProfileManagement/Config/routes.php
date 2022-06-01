<?php

$routes->group('profile', ['namespace' => 'Modules\ProfileManagement\Controllers'], function($routes){

    $routes->get('/', 'UpdatePassword::index');
    $routes->match(['get', 'post'], 'change', 'UpdatePassword::change_password');

    $routes->match(['get', 'post'], 'activity', 'ActivityLog::index');
    $routes->match(['get', 'post'], 'activityDetail/(:num)', 'ActivityLog::activity_log_detail/$1');

    //user accounts
  	$routes->get('students', 'Students::index');
  	$routes->post('students/insert-spreadsheet', 'Students::insertSpreadsheet');
  	$routes->match(['get', 'post'], 'students/add', 'Students::add');
  	// $routes->match(['get', 'post'], 'edit/(:num)', 'Students::edit/$1');
  	// $routes->get('delete/(:num)', 'Students::delete/$1');

  	$routes->get('professors', 'Professors::index');
    $routes->get('view', 'Professors::view_profile');

  	$routes->post('professors/insert-spreadsheet', 'Professors::insertSpreadsheet');
  	$routes->match(['get', 'post'], 'professors/add', 'Professors::add');
    $routes->match(['get', 'post'], 'professors/addSeminar', 'Professors::add_seminar');
    $routes->match(['get', 'post'], 'professors/addPublication', 'Professors::add_publication');
    $routes->match(['get', 'post'], 'professors/pResearchDetail/(:num)', 'Professors::view_pResearch/$1');
    $routes->match(['get', 'post'], 'professors/editPresearch/(:num)', 'Professors::edit_pResearch/$1');

    $routes->match(['get', 'post'], 'professors/seminar', 'Professors::seminar');
    $routes->match(['get', 'post'], 'professors/delSeminar/(:num)', 'Professors::delete_seminar/$1');
    $routes->match(['get', 'post'], 'professors/delPublication/(:num)', 'Professors::delete_publication/$1');

    $routes->match(['get', 'post'], 'viewFaculty/(:num)', 'Professors::view_faculty/$1');

    $routes->match(['get', 'post'], 'seminarPDF', 'Professors::print_seminarPDF');
    $routes->match(['get', 'post'], 'perSeminarPDF/(:num)', 'Professors::print_per_seminarPDF/$1');

    $routes->match(['get', 'post'], 'seminarCSV', 'Professors::print_seminarCSV');
    $routes->match(['get', 'post'], 'perSeminarCSV/(:num)', 'Professors::print_per_seminarCSV/$1');

    $routes->match(['get', 'post'], 'completedPDF/(:alphanum)/(:alphanum)', 'Professors::print_completedPDF/$1/$2');
    $routes->match(['get', 'post'], 'publishedPDF/(:alphanum)/(:alphanum)', 'Professors::print_publishedPDF/$1/$2');
    $routes->match(['get', 'post'], 'perCompletedPDF/(:alphanum)/(:alphanum)/(:alphanum)', 'Professors::print_per_completedPDF/$1/$2/$3');
    $routes->match(['get', 'post'], 'perPublishedPDF/(:alphanum)/(:alphanum)/(:alphanum)', 'Professors::print_per_publishedPDF/$1/$2/$3');

    $routes->match(['get', 'post'], 'completedCSV/(:alphanum)/(:alphanum)', 'Professors::print_completedCSV/$1/$2');
    $routes->match(['get', 'post'], 'publishedCSV/(:alphanum)/(:alphanum)', 'Professors::print_publishedCSV/$1/$2');
    $routes->match(['get', 'post'], 'perCompletedCSV/(:alphanum)/(:alphanum)/(:alphanum)', 'Professors::print_per_completedCSV/$1/$2/$3');
    $routes->match(['get', 'post'], 'perPublishedCSV/(:alphanum)/(:alphanum)/(:alphanum)', 'Professors::print_per_publishedCSV/$1/$2/$3');


    $routes->match(['get', 'post'], 'tagPublish/(:num)', 'Professors::tag_as_published/$1');
    $routes->match(['get', 'post'], 'updatePublication/(:num)', 'Professors::update_publication/$1');
    $routes->match(['get', 'post'], 'removeProof/(:num)', 'Professors::remove_proof/$1');

    $routes->match(['get', 'post'], 'trash', 'TrashBin::index');
    $routes->match(['get', 'post'], 'documentRestore/(:num)', 'TrashBin::restore_document/$1');
    $routes->match(['get', 'post'], 'forumRestore/(:num)', 'TrashBin::restore_forum/$1');
    $routes->match(['get', 'post'], 'documentView/(:num)', 'TrashBin::document_view/$1');
    $routes->match(['get', 'post'], 'forumView/(:num)', 'TrashBin::forum_view/$1');

});
