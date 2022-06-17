<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Frontend\HomePageController::index');
$routes->get('rooms','Frontend\RoomController::index');
$routes->post('rooms/reservation','Frontend\RoomController::book');
$routes->get('rooms/detail/(:any)','Frontend\RoomController::roomDetail/$1');
$routes->get('rooms/category/(:num)','Frontend\RoomController::filterCategory/$1');
$routes->post('signup','Frontend\AuthController::signup');
$routes->post('signin','Frontend\AuthController::signin');
$routes->get('signout', 'Frontend\AuthController::signout');

$routes->group("internal", ["namespace" => "App\Controllers\Internal"], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index', ['filter' => 'authAdmin']);

    $routes->get('signin', 'AuthController::getSignIn');
    $routes->get('signout', 'AuthController::getSignout');
    $routes->post('signin', 'AuthController::postSignIn');

    //Room Category
    $routes->get('room_categories', 'RoomCategoryController::index', ['filter' => 'authAdmin']);
    $routes->get('room_categories/create', 'RoomCategoryController::create', ['filter' => 'authAdmin']);
    $routes->post('room_categories/store', 'RoomCategoryController::store', ['filter' => 'authAdmin']);
    $routes->get('room_categories/edit/(:num)', 'RoomCategoryController::edit/$1', ['filter' => 'authAdmin']);
    $routes->post('room_categories/update/(:num)', 'RoomCategoryController::update/$1', ['filter' => 'authAdmin']);
    $routes->get('room_categories/delete/(:num)', 'RoomCategoryController::delete/$1', ['filter' => 'authAdmin']);

    //Room
    $routes->get('rooms', 'RoomController::index', ['filter' => 'authAdmin']);
    $routes->get('rooms/create', 'RoomController::create', ['filter' => 'authAdmin']);
    $routes->post('rooms/store', 'RoomController::store', ['filter' => 'authAdmin']);
    $routes->get('rooms/edit/(:num)', 'RoomController::edit/$1', ['filter' => 'authAdmin']);
    $routes->post('rooms/update/(:num)', 'RoomController::update/$1', ['filter' => 'authAdmin']);
    $routes->get('rooms/delete/(:num)', 'RoomController::delete/$1', ['filter' => 'authAdmin']);

    //Room Image
    $routes->get('room_images', 'RoomImageController::index', ['filter' => 'authAdmin']);
    $routes->get('room_images/create', 'RoomImageController::create', ['filter' => 'authAdmin']);
    $routes->post('room_images/store', 'RoomImageController::store', ['filter' => 'authAdmin']);
    $routes->get('room_images/edit/(:num)', 'RoomImageController::edit/$1', ['filter' => 'authAdmin']);
    $routes->get('room_images/show-images/(:num)', 'RoomImageController::show/$1', ['filter' => 'authAdmin']);
    $routes->post('room_images/update/(:num)', 'RoomImageController::update/$1', ['filter' => 'authAdmin']);
    $routes->get('room_images/deleteImageById/(:num)', 'RoomImageController::deleteImageById/$1', ['filter' => 'authAdmin']);
    $routes->get('room_images/deleteAllImages/(:num)', 'RoomImageController::deleteAllImages/$1', ['filter' => 'authAdmin']);

    //Users
    $routes->get('users', 'UserController::index', ['filter' => 'authAdmin']);
    $routes->get('users/create', 'UserController::create', ['filter' => 'authAdmin']);
    $routes->post('users/store', 'UserController::store', ['filter' => 'authAdmin']);
    $routes->get('users/edit/(:num)', 'UserController::edit/$1', ['filter' => 'authAdmin']);
    $routes->post('users/update/(:num)', 'UserController::update/$1', ['filter' => 'authAdmin']);
    $routes->get('users/delete/(:num)', 'UserController::delete/$1', ['filter' => 'authAdmin']);

    //Employees
    $routes->get('employees', 'EmployeeController::index',['filter'=>'authAdmin']);
    $routes->get('employees/create', 'EmployeeController::create',['filter'=>'authAdmin']);
    $routes->post('employees/store', 'EmployeeController::store',['filter'=>'authAdmin']);
    $routes->get('employees/edit/(:num)', 'EmployeeController::edit/$1',['filter'=>'authAdmin']);
    $routes->post('employees/update/(:num)', 'EmployeeController::update/$1',['filter'=>'authAdmin']);
    $routes->get('employees/delete/(:num)', 'EmployeeController::delete/$1',['filter'=>'authAdmin']);

    //Reservation
    $routes->get('reservations', 'ReservationController::index',['filter'=>'authAdmin']);

    // Resume Personal Informations
    $routes->get('resume_personal_informations/', 'ResumePersonalInformationController::index');
    $routes->get('resume_personal_informations/create', 'ResumePersonalInformationController::create');
    $routes->post('resume_personal_informations/store', 'ResumePersonalInformationController::store');
    $routes->get('resume_personal_informations/edit/(:num)', 'ResumePersonalInformationController::edit/$1');
    $routes->post('resume_personal_informations/update/(:num)', 'ResumePersonalInformationController::update/$1');
    $routes->get('resume_personal_informations/delete/(:num)', 'ResumePersonalInformationController::delete/$1');

    // Resume Work Experiences
    $routes->get('resume_work_experiences/', 'ResumeWorkExperienceController::index');
    $routes->get('resume_work_experiences/create', 'ResumeWorkExperienceController::create');
    $routes->post('resume_work_experiences/store', 'ResumeWorkExperienceController::store');
    $routes->get('resume_work_experiences/edit/(:num)', 'ResumeWorkExperienceController::edit/$1');
    $routes->post('resume_work_experiences/update/(:num)', 'ResumeWorkExperienceController::update/$1');
    $routes->get('resume_work_experiences/delete/(:num)', 'ResumeWorkExperienceController::delete/$1');

    // Resume Educations
    $routes->get('resume_educations/', 'ResumeEducationController::index');
    $routes->get('resume_educations/create', 'ResumeEducationController::create');
    $routes->post('resume_educations/store', 'ResumeEducationController::store');
    $routes->get('resume_educations/edit/(:num)', 'ResumeEducationController::edit/$1');
    $routes->post('resume_educations/update/(:num)', 'ResumeEducationController::update/$1');
    $routes->get('resume_educations/delete/(:num)', 'ResumeEducationController::delete/$1');

    // Resume Organizational Experiences
    $routes->get('resume_organizational_experiences/', 'ResumeOrganizationalExperienceController::index');
    $routes->get('resume_organizational_experiences/create', 'ResumeOrganizationalExperienceController::create');
    $routes->post('resume_organizational_experiences/store', 'ResumeOrganizationalExperienceController::store');
    $routes->get('resume_organizational_experiences/edit/(:num)', 'ResumeOrganizationalExperienceController::edit/$1');
    $routes->post('resume_organizational_experiences/update/(:num)', 'ResumeOrganizationalExperienceController::update/$1');
    $routes->get('resume_organizational_experiences/delete/(:num)', 'ResumeOrganizationalExperienceController::delete/$1');

    // Generate Resume
    $routes->get('generate_resume/','GenerateCVController::index');
    $routes->get('generate_resume/(:num)','GenerateCVController::generate/$1');
    $routes->get('download_excel/(:num)','GenerateCVController::export/$1');
});
/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
