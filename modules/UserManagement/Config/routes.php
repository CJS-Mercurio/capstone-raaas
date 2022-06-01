<?php

$routes->group('userManagement', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){


      $routes->get('/', 'UserAccounts::index');
      $routes->match(['get', 'post'], 'approve', 'UserAccounts::approve_account');
      $routes->match(['get', 'post'], 'disapprove', 'UserAccounts::disapprove_account');
      $routes->match(['get','post'], 'userRegistration/(:num)', 'UserAccounts::user_register_request/$1');

      ///////////

      $routes->match(['get','post'], 'studRegistration/(:num)', 'UserAccounts::student_register_request/$1');
    	$routes->match(['get','post'], 'studRegister/(:num)', 'UserAccounts::s_register_request/$1');
    	$routes->match(['get','post'], 'profRegistration/(:num)', 'UserAccounts::prof_register_request/$1');
    	$routes->match(['get','post'], 'userRegistration/(:num)', 'UserAccounts::user_register_request/$1');
    	$routes->match(['get','post'], 'profRegister/(:num)', 'UserAccounts::p_register_request/$1');
    	$routes->match(['get','post'], 'unactivated', 'UserAccounts::unactivated_account');


    	$routes->match(['get','post'], 'studActivate/(:num)', 'UserAccounts::student_activate_account/$1');
    	$routes->match(['get','post'], 'profActivate/(:num)', 'UserAccounts::professor_activate_account/$1'); //used
    	$routes->match(['get','post'], 'userActivate/(:num)', 'UserAccounts::user_activate_account/$1'); //used


    	$routes->match(['get','post'], 'studDeactivate/(:num)', 'UserAccounts::student_deactivate_account/$1');
    	$routes->match(['get','post'], 'profDeactivate/(:num)', 'UserAccounts::professor_deactivate_account/$1');  //used
    	$routes->match(['get','post'], 'userDeactivate/(:num)', 'UserAccounts::user_deactivate_account/$1'); //used


    	$routes->match(['get','post'], 'activateConfirm/(:alphanum)', 'UserAccounts::activation_confirm/$1');

    	$routes->match(['get','post'], 'delStudentExpAcc/(:num)', 'UserAccounts::delete_student_expired_account/$1');
    	$routes->match(['get','post'], 'delProfExpAcc/(:num)', 'UserAccounts::delete_prof_expired_account/$1');
    	$routes->match(['get','post'], 'delUserExpAcc/(:num)', 'UserAccounts::delete_user_expired_account/$1');

});
