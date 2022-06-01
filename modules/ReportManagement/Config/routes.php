<?php

$routes->group('report', ['namespace' => 'Modules\ReportManagement\Controllers'], function($routes){


      $routes->get('/', 'ResearchReport::index');

      $routes->get('reports', 'ResearchReport::index');
      $routes->match(['get', 'post'], 'reportDashboard', 'ResearchReport::report_dashboard');
      $routes->match(['get', 'post'], 'reportByCourse', 'ResearchReport::report_by_course');
      $routes->match(['get', 'post'], 'research', 'ResearchReport::research_report');
      $routes->match(['get', 'post'], 'seminar', 'ResearchReport::seminar_report');
      $routes->match(['get', 'post'], 'pResearch', 'ResearchReport::pResearch_report');

      $routes->match(['get', 'post'], 'profSeminar', 'ResearchReport::prof_seminar');
      $routes->match(['get', 'post'], 'profPubResearch', 'ResearchReport::prof_published_research');

      $routes->match(['get', 'post'], 'reportAllCoursePdf/(:num)/(:num)/(:num)', 'ResearchReport::report_all_course_pdf/$1/$2/$3');
      $routes->match(['get', 'post'], 'reportPerCoursePdf/(:num)/(:num)/(:num)', 'ResearchReport::report_per_course_pdf/$1/$2/$3');
      $routes->match(['get', 'post'], 'reportAllCourseCsv/(:num)/(:num)', 'ResearchReport::report_all_course_csv/$1/$2');
      $routes->match(['get', 'post'], 'reportPerCourseCsv/(:num)/(:num)/(:num)', 'ResearchReport::report_per_course_csv/$1/$2/$3');

      $routes->match(['get', 'post'], 'listCourse/(:num)/(:num)/(:num)', 'ResearchReport::cont_list_course/$1/$2/$3');

});
