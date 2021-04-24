<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method/control_login/Login_main
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// admin
$route['LogoutAdmin'] = "Control_login/";
$route['AdminHome'] = "admin/ConAdminHome/AdminHome";

$route['Admin/AcademicResult'] = "admin/ConAdminAcademinResult/AdminAcademinResultMain";

$route['Admin/ClassSchedule'] = "admin/ConAdminClassSchedule/AdminClassScheduleMain";
$route['Admin/ClassSchedule/add'] = "admin/ConAdminClassSchedule/add";

$route['Admin/ExamSchedule'] = "admin/ConAdminExamSchedule/AdminExamScheduleMain";
$route['Admin/ExamSchedule/add'] = "admin/ConAdminExamSchedule/add";

$route['Admin/ClassRoom'] = "admin/ConAdminClassRoom/AdminClassMain";

// Login
$route['Logout'] = "Control_login/logout";
$route['Login'] = "Control_login/Login_main";

// Teacher
$route['Teacher/Home'] = "teacher/ConTeacherHome/TeacherHome";
$route['Teacher/Course'] = "teacher/ConTeacherCourse/Course";
$route['Teacher/Course/SendPlan'] = "teacher/ConTeacherCourse/send_plan";
$route['Teacher/Course/CheckPlan'] = "teacher/ConTeacherCourse/check_plan";
$route['Teacher/Course/CheckPlan/(:any)'] = "teacher/ConTeacherCourse/check_plan/$1";

// User
$route['Home'] = "user/ConUser_Home/Home";
$route['AcademicResult'] = "user/ConAcademicResult/score";
$route['ExamSchedule'] = "user/ConStudents/ExamSchedule";
$route['Students'] = "user/ConStudents";
$route['StudentsList'] = "user/ConStudents/StudentsList";