<?php

$routes->group('forum', ['namespace' => 'Modules\ForumManagement\Controllers', 'filter'=> 'isLoggedIn'], function($routes){


	$routes->get('/', 'ForumHome::index');
	//														  name ng form / Controller / function
  $routes->match(['get', 'post'], 'addForum', 'ForumHome::addForum');
	$routes->match(['get', 'post'], 'deleteForum/(:num)', 'ForumHome::delete_forum/$1');
	$routes->match(['get', 'post'], 'editForum/(:num)', 'ForumHome::edit_forum/$1');
	$routes->match(['get', 'post'], 'viewForum/(:num)', 'ForumHome::view_forum/$1');
	$routes->match(['get', 'post'], 'viewUserForum/(:num)', 'ForumHome::view_forum_user/$1');

	$routes->match(['get', 'post'], 'toApproveForum', 'ForumHome::toApprove_forum');

	$routes->match(['get', 'post'], 'postForum/(:num)', 'ForumHome::post_forum/$1');
	$routes->match(['get', 'post'], 'unpostForum/(:num)', 'ForumHome::unpost_forum/$1');
	$routes->match(['get', 'post'], 'adminViewForum/(:num)', 'ForumHome::admin_view_forum/$1');
	$routes->match(['get', 'post'], 'approveForum/(:num)', 'ForumHome::admin_approve_forum/$1');
	$routes->match(['get', 'post'], 'disapproveForum/(:num)', 'ForumHome::admin_disapprove_forum/$1');
	$routes->match(['get', 'post'], 'adminEditForum/(:num)', 'ForumHome::admin_edit_forum/$1');

	$routes->match(['get', 'post'], 'submitAgain/(:num)', 'ForumHome::submit_again/$1');




});
