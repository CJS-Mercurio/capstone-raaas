<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index', ['filter' => 'noauth']);
$routes->get('guest', 'Login::guest', ['filter' => 'noauth']);
$routes->match(['get','post'], 'guest_view/(:num)', 'Login::guest_view/$1', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'forgot_pass', 'Login::forgot_password', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'about', 'Login::about', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'metrics', 'Login::metrics', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'loginV', 'Login::loginV', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'login_faculty', 'Login::loginFaculty', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'login_view', 'Login::index', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'guest_researchV', 'Login::guest_researchV', ['filter' => 'noauth']);
// $routes->match(['get', 'post'], 'reset_pass', 'Login::reset_password');

$routes->get('logout', 'Login::logout');
// $routes->get('logout', 'Users::logout');
$routes->match(['get','post'],'reg_student/(:num)', 'Register::reg_student/$1', ['filter' => 'noauth']);
$routes->match(['get','post'],'reg_professor/(:num)', 'Register::reg_professor/$1', ['filter' => 'noauth']);
$routes->match(['get','post'],'reg_member/(:num)', 'Register::reg_member/$1', ['filter' => 'noauth']);
$routes->match(['get','post'],'choose_role', 'Register::choose_role', ['filter' => 'noauth']);


$routes->match(['get', 'post'], 'viewGuestForum/(:num)', 'Login::view_forum_guest/$1');

// $routes->match(['get','post'],'profile', 'Users::profile',['filter' => 'auth']);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}




/**
 * --------------------------------------------------------------------
 * Modules Routing
 * --------------------------------------------------------------------
 */

if(file_exists(ROOTPATH. 'modules'));
	$modulesPath = ROOTPATH.'modules';
	$modules = scandir($modulesPath);
    
	foreach($modules as $module){
		if($module === '.' || $module === '..') continue;
		if(is_dir($modulesPath) . '/' . $module){
			$routesPath = $modulesPath . '/' . $module . '/Config/routes.php';
// 			die($routesPath);
			if(file_exists($routesPath)){
				require($routesPath);
				}
				else{
					continue;
				}
			}
		}
