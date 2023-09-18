<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// //! Login
// $routes->get('/', 'Home::index');
// $routes->post('/ceklogin', 'Home::CekLogin');


// //! Registrasi
// $routes->get('/register', 'Home::Register');
// $routes->post('/saveregister', 'Home::SaveRegister');


// //! Logout
// $routes->get('/logout', 'Home::Logout');


//! Profile Masyarakat
$routes->get('/', 'ControllerProfile');
$routes->post('/updateprofile/(:num)', 'ControllerProfile::UpdateProfile/$1');


//! Profile Admin
$routes->get('/profile-admin', 'ControllerProfile::PetugasProfile');
$routes->post('/updateprofile-admin/(:num)', 'ControllerProfile::UpdateProfilePetugas/$1');


//! Pengaduan Masyarakat
$routes->get('/pengaduan', 'ControllerPengaduan');
$routes->post('/add-pengaduan', 'ControllerPengaduan::InsertData');
$routes->post('/edit-pengaduan/(:num)', 'ControllerPengaduan::UpdateData/$1');
$routes->get('/delete-pengaduan/(:num)', 'ControllerPengaduan::DeleteData/$1');


//! Pengaduan Admin
$routes->get('/pengaduan-admin', 'ControllerPengaduan::PetugasIndex');
$routes->post('/add-tanggapan/(:num)', 'ControllerTanggapan::InsertData/$1');


//! Tanggapan Masyarakat
$routes->get('/tanggapan', 'ControllerTanggapan');
$routes->get('/delete-tanggapan/(:num)', 'ControllerTanggapan::DeleteData/$1');


//! Tanggapan Admin
$routes->get('/tanggapan-admin', 'ControllerTanggapan::PetugasIndex');
$routes->get('/apply-tanggapan/(:num)', 'ControllerTanggapan::ApplyData/$1');


//! User
$routes->get('/user', 'ControllerUser');
$routes->post('/edit-user/(:num)', 'ControllerUser::UpdateData/$1');
$routes->get('/delete-user/(:num)', 'ControllerUser::DeleteData/$1');


//! Admin
$routes->get('/admin', 'ControllerAdmin');
$routes->post('/add-admin', 'ControllerAdmin::InsertData');
$routes->post('/edit-admin/(:num)', 'ControllerAdmin::UpdateData/$1');
$routes->get('/delete-admin/(:num)', 'ControllerAdmin::DeleteData/$1');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
