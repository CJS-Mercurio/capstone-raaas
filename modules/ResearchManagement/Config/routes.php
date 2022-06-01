<?php

$routes->group('research', ['namespace' => 'Modules\ResearchManagement\Controllers'], function($routes){

    $routes->get('/', 'UploadResearch::index');
    $routes->match(['get', 'post'], 'upload', 'UploadResearch::upload_research');
    $routes->match(['get', 'post'], 'viewResearch/(:num)', 'UploadResearch::view_research/$1');
    $routes->match(['get', 'post'], 'viewResearchHome/(:num)', 'UploadResearch::view_research_home/$1');
    $routes->match(['get', 'post'], 'editResearch/(:num)', 'UploadResearch::edit_research/$1');
    $routes->match(['get', 'post'], 'editAddPanel/(:num)', 'UploadResearch::edit_add_panel/$1');

    $routes->match(['get', 'post'], 'deleteResearch/(:num)', 'UploadResearch::delete_research/$1');
    $routes->match(['get', 'post'], 'downloadResearch/(:alphanum)', 'UploadResearch::download_research/$1');
    $routes->match(['get', 'post'], 'pdfResearch/(:num)', 'Voucher::index/$1');
    $routes->match(['get', 'post'], 'addPanelist', 'UploadResearch::add_panelist');
    $routes->match(['get', 'post'], 'terms', 'UploadResearch::privacy_policy');

    $routes->match(['get', 'post'], 'config', 'ConfigureResearch::index');

    $routes->match(['get','post'], 'addFaculty', 'ConfigureResearch::add_faculty');
  	$routes->match(['get','post'], 'setSY', 'ConfigureResearch::set_school_year');
  	$routes->match(['get','post'], 'setDir', 'ConfigureResearch::set_director');
    $routes->match(['get','post'], 'setSched', 'ConfigureResearch::set_schedule');
    $routes->match(['get','post'], 'empty', 'ConfigureResearch::empty_table');
    $routes->match(['get','post'], 'removeSched/(:num)', 'ConfigureResearch::remove_schedule/$1');


    $routes->match(['get','post'], 'deactFaculty/(:num)', 'ConfigureResearch::deact_faculty/$1');
  	$routes->match(['get','post'], 'actFaculty/(:num)', 'ConfigureResearch::act_faculty/$1');

    $routes->match(['get', 'post'], 'getStudentResearch', 'UploadResearch::get_student_research');
  	$routes->match(['get', 'post'], 'getProfResearch', 'UploadResearch::get_professor_research');

    $routes->match(['get', 'post'], 'chooseDocType', 'UploadResearch::choose_document_type');
    $routes->match(['get', 'post'], 'downloadCite/(:num)', 'UploadResearch::download_citation/$1');

    //submit again
    $routes->match(['get', 'post'], 'adminSubmit/(:num)', 'UploadResearch::admin_submit_again/$1');
    $routes->match(['get', 'post'], 'advSubmit/(:num)', 'UploadResearch::adviser_submit_again/$1');

    //approval
    $routes->match(['get', 'post'], 'profApproval', 'ProfResearchApproval::index');
    $routes->match(['get', 'post'], 'viewToApprove/(:num)', 'ProfResearchApproval::view_research_to_approve/$1');
    $routes->match(['get', 'post'], 'approveRes/(:num)', 'ProfResearchApproval::approve_research/$1');
    $routes->match(['get', 'post'], 'disapproveRes/(:num)', 'ProfResearchApproval::disapprove_research/$1');

    $routes->match(['get', 'post'], 'adminApproval', 'ProfResearchApproval::admin_toApprove_research');
    $routes->match(['get', 'post'], 'adminViewRes/(:num)', 'ProfResearchApproval::admin_view_research/$1');
    $routes->match(['get', 'post'], 'listProf', 'ProfResearchApproval::pending_list_prof');
    $routes->match(['get', 'post'], 'listStudent', 'ProfResearchApproval::pending_list_student');
    $routes->match(['get', 'post'], 'adminApproveRes/(:num)', 'ProfResearchApproval::admin_approve_research/$1');
    $routes->match(['get', 'post'], 'adminDisapproveRes/(:num)', 'ProfResearchApproval::admin_disapprove_research/$1');

    $routes->match(['get', 'post'], 'editAddAuthor/(:num)', 'UploadResearch::edit_add_author/$1');
    $routes->match(['get', 'post'], 'addAuthor', 'UploadResearch::add_author');

    //my library
    $routes->match(['get', 'post'], 'myLibHome', 'MyLibrary::index');
    $routes->match(['get', 'post'], 'addFavorite/(:num)', 'MyLibrary::add_favorite/$1');
    $routes->match(['get', 'post'], 'removeFavorite/(:num)', 'MyLibrary::remove_favorite/$1');

    //Analytics
    $routes->match(['get', 'post'], 'analyticsHome', 'Analytics::index');

    $routes->match(['get', 'post'], 'scan', 'Voucher::scan');

    $routes->match(['get', 'post'], 'copyright/(:num)', 'UploadResearch::upload_copyright/$1');
    $routes->match(['get', 'post'], 'updateCopyright/(:num)', 'UploadResearch::update_copyright/$1');
    $routes->match(['get', 'post'], 'removeCert/(:num)', 'UploadResearch::remove_certificate/$1');

});
