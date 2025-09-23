<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/auth/doLogin', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('dashboard', 'Dashboard::index');

$routes->get('courses', 'Courses::index');             // halaman utama courses
$routes->get('courses/api', 'Courses::api');
$routes->post('courses/enroll', 'Courses::enroll');    // enroll mahasiswa ke course
$routes->delete('courses/unenroll/(:num)', 'Courses::unenroll/$1'); // hapus enrollment
$routes->post('courses/delete', 'Courses::delete');


$routes->get('/admin', 'Admin::index');
$routes->post('/admin/addCourse', 'Admin::addCourse');
$routes->post('admin/addStudent', 'Admin::addStudent');
$routes->get('/admin/deleteCourse/(:num)', 'Admin::deleteCourse/$1');
$routes->get('/admin/deleteStudent/(:num)', 'Admin::deleteStudent/$1');
