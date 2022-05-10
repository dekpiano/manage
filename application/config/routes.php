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


$route['ClosePage'] = "welcome/ClosePage";
// งานวิชาการ
$route['LoginAdmin'] = "Control_login/LoginAdmin";
$route['Admin/Home'] = "admin/academic/ConAdminHome/AdminHome";
$route['Admin/Acade/AcademicResult'] = "admin/academic/ConAdminAcademinResult/AdminAcademinResultMain";
$route['Admin/Acade/ClassSchedule'] = "admin/academic/ConAdminClassSchedule/AdminClassScheduleMain";
$route['Admin/ClassSchedule/add'] = "admin/academic/ConAdminClassSchedule/add";
$route['Admin/Acade/ExamSchedule'] = "admin/academic/ConAdminExamSchedule/AdminExamScheduleMain";
$route['Admin/ExamSchedule/add'] = "admin/academic/ConAdminExamSchedule/add";
$route['Admin/Acade/ClassRoom'] = "admin/academic/ConAdminClassRoom/AdminClassMain";
$route['Admin/Acade/Students'] = "admin/academic/ConAdminStudents/AdminStudentsMain";
$route['Admin/Acade/RegisterSubject'] = "admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectMain";
$route['Admin/Acade/ExtraSubject'] = "admin/academic/ConAdminExtraSubject";
$route['Admin/Acade/SettingSystem'] = "admin/academic/ConAdminExtraSubject/SystemMainExtraSubject";
$route['Admin/Acade/Report'] = "admin/academic/ConAdminExtraSubject/ExtraReport";
$route['Admin/Acade/RoomOnline'] = "admin/academic/ConAdminRoomOnline/RoomOnlineMain";
$route['Admin/Acade/AdminRoles'] = "admin/academic/ConAdminSettingAdminRoles/AcademicSettingAdminRoles";

// งานกิจการนักเรียน
$route['Admin/Affairs/StudentSupport/HomeVisit/Setting'] = "admin/Affairs/ConAdminStudentSupport/PageMainSetting";

// Login
$route['Logout'] = "Control_login/logout";
$route['LogoutTeacher'] = "Control_login/logoutGoogle";
$route['LoginStudent'] = "Control_login/LoginStudent";
$route['LoginTeacher'] = "Control_login/LoginTeacher";
//$route['LoginTeacher'] = "Control_login/LoginTeacherMain";

// Teacher
$route['Teacher/Home'] = "teacher/ConTeacherHome/TeacherHome";
$route['Teacher/Course'] = "teacher/ConTeacherCourse/Course";
$route['Teacher/Course/LoadPlan'] = "teacher/ConTeacherCourse/LoadPlan";
$route['Teacher/Course/SendPlan'] = "teacher/ConTeacherCourse/send_plan";
$route['Teacher/Course/EditPlan/(:num)'] = "teacher/ConTeacherCourse/edit_plan/$1";
$route['Teacher/Course/CheckPlan'] = "teacher/ConTeacherCourse/check_plan";
$route['Teacher/Course/Setting'] = "teacher/ConTeacherCourse/setting_plan";
$route['Teacher/Course/SettingTeacher'] = "teacher/ConTeacherCourse/setting_teacher";
$route['Teacher/Course/CheckPlan/(:any)'] = "teacher/ConTeacherCourse/check_plan_lear/$1";
$route['Teacher/Course/CheckPlan/(:any)/(:any)'] = "teacher/ConTeacherCourse/check_plan_lear_techer/$1/$2";
$route['Teacher/Course/Delete/(:any)']['delete'] = "teacher/ConTeacherCourse/delete_plan/$1";
$route['Teacher/Course/ReportPlan'] = "teacher/ConTeacherCourse/report_plan";
$route['Teacher/Course/ReportPlan/(:any)'] = "teacher/ConTeacherCourse/report_plan/$1";
$route['Teacher/Course/DownloadPlan'] = "teacher/ConTeacherCourse/DownloadPlan";
$route['Teacher/Course/DownloadPlanZip/(:any)'] = "teacher/ConTeacherCourse/DownloadPlanZip/$1";
$route['Teacher/Profile'] = "teacher/ConTeacherProfile/ProfileMain";
$route['Teacher/Teaching/CheckHomeRoom'] = "teacher/ConTeacherTeaching/CheckHomeRoom";
$route['Teacher/Teaching/CheckTeaching'] = "teacher/ConTeacherTeaching/CheckTeaching";
$route['Teacher/Teaching/RoomOnlineMain'] = "teacher/ConTeacherTeaching/RoomOnlineMain";

$route['Teacher/SupStd/Main'] = "teacher/ConTeacherStudentSupport/SupStdMain";
$route['Teacher/SupStd/CheckWorkManager'] = "teacher/ConTeacherStudentSupport/SupStdCheckWorkManager";
$route['Teacher/SupStd/CheckWorkExecutive'] = "teacher/ConTeacherStudentSupport/SupStdCheckWorkExecutive";
$route['Teacher/SupStdMain/Add'] = "teacher/ConTeacherStudentSupport/SupStdAdd";


//Student
$route['Student/AcademicResult'] = "student/ConStudentHome/score";
$route['Student/Home'] = "student/ConStudentHome/Home";

$route['Student/Extra/Subject'] = "student/ConStudentExtraSubject/ExtraSubject";
$route['Student/Extra/ReadMe'] = "student/ConStudentExtraSubject/ReadMe";
$route['Student/Extra/CheckRegister'] = "student/ConStudentExtraSubject/CheckRegister";

// User
$route['ExamSchedule'] = "user/ConStudents/ExamSchedule";
$route['ExamScheduleOnline'] = "user/ConStudents/ExamScheduleOnline";
$route['Students'] = "user/ConStudents";
$route['StudentsList'] = "user/ConStudents/StudentsList";
$route['ClassSchedule'] = "user/ConStudents/ClassSchedule";

$route['LearningOnline'] = "user/ConStudents/LearningOnline";
$route['LearningOnline/(:any)'] = "user/ConStudents/LearningOnlineDetail/$1";

$route['ReportLearnOnline'] = "user/ConStudents/PageReportLearnOnline";