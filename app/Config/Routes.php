<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/auth/doLogin', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/courses', 'Courses::index');
$routes->get('/courses/enroll/(:num)', 'Courses::enroll/$1');

$routes->get('/admin', 'Admin::index');
$routes->post('/admin/addCourse', 'Admin::addCourse');
$routes->get('/admin/deleteCourse/(:num)', 'Admin::deleteCourse/$1');
$routes->get('/admin/deleteStudent/(:num)', 'Admin::deleteStudent/$1');
