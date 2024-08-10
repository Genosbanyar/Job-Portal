<?php
require "function.php";
$routes = [
    '' => "controller/indexController.php",
    'login' => "controller/loginController.php",
    'registration' => "controller/registrationController.php",
    'contact' => "controller/contactController.php",
    'about' => "controller/aboutController.php",
    'logout' => "controller/logoutController.php",
    'post_job' => "controller/post_jobController.php",
    'update_profile' => "controller/update_profileController.php",
    'my_profile' => "controller/profileController.php",
    'company' => "controller/companiesController.php",
    'job_single' => "controller/jobSingleController.php",
    'delete' => "controller/deleteController.php",
    'update_job' => "controller/update_jobController.php",
    'job_save' => "controller/job_saveController.php",
    'saved_job' => "controller/saved_jobsController.php",
    'job_applicant' => "controller/job_applicantController.php",
    'show_jobs' => "controller/show_jobsController.php",
    'employee' => "controller/employeeController.php",
    'search' => "controller/searchController.php",
    'admin_login' => "controller/admin_loginController.php",
    'categories_admin' => "controller/categories_adminController.php",
    'admin_show' => "controller/admin_showController.php",
    'admin_jobs' => "controller/admin_jobsController.php",
    'create_admins' => "controller/create_adminsController.php",
    'admin_logout' => "controller/admin_logoutController.php",
    'home' => "controller/homeController.php",
    'create_cate' => "controller/create_cateController.php",
    'delete_cate' => "controller/delete_cateController.php",
    'update_cate' => "controller/update_cateController.php",
    'status' => "controller/statusController.php",
    'delete_job' => "controller/delete_jobController.php"
];

$url=trim($_SERVER['REQUEST_URI'], "/");
// dd(explode("?","single"));
function pageController($urls,$routes){
    $route = explode("?",$urls)[0];
    if(array_key_exists($route, $routes)){
        require $routes[$route];
    }else{
        abort(404);
    }
}
pageController($url,$routes);