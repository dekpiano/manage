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
$route['Admin/Acade/Registration/Enroll'] = "admin/academic/ConAdminEnroll/AdminEnrollMain";
$route['Admin/Acade/Registration/Enroll/Add/(:any)/(:any)'] = "admin/academic/ConAdminEnroll/AdminEnrollAdd/$1/$2";
$route['Admin/Acade/Registration/Enroll/Edit/(:any)/(:any)'] = "admin/academic/ConAdminEnroll/AdminEnrollEdit/$1/$2";
$route['Admin/Acade/Registration/Enroll/Delete/(:any)/(:any)'] = "admin/academic/ConAdminEnroll/AdminEnrollDelete/$1/$2";
$route['Admin/Acade/Registration/Repeat'] = "admin/academic/ConAdminRegisRepeat/AdminRegisRepeatMain";
$route['Admin/Acade/Registration/Repeat/Detail/(:any)/(:any)/(:any)'] = "admin/academic/ConAdminRegisRepeat/AdminRegisRepeatDetail/$1/$2/$3";
$route['Admin/Acade/Registration/Repeat/Add'] = "admin/academic/ConAdminRegisRepeat/AdminRegisRepeatAdd";
$route['Admin/Acade/Registration/ClassSchedule'] = "admin/academic/ConAdminClassSchedule/AdminClassScheduleMain";
$route['Admin/Acade/Registration/ClassSchedule/add'] = "admin/academic/ConAdminClassSchedule/add";
$route['Admin/Acade/Registration/ExamSchedule'] = "admin/academic/ConAdminExamSchedule/AdminExamScheduleMain";
$route['Admin/Acade/Registration/ExamSchedule/add'] = "admin/academic/ConAdminExamSchedule/add";
$route['Admin/Acade/Registration/ClassRoom'] = "admin/academic/ConAdminClassRoom/AdminClassMain";
$route['Admin/Acade/Registration/Students/(:any)'] = "admin/academic/ConAdminStudents/AdminStudentsMain/$1";
$route['Admin/Acade/Registration/StudentsUpdate'] = "admin/academic/ConAdminStudents/AdminStudentsUpdate";
$route['Admin/Acade/Registration/RegisterSubject'] = "admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectMain";
$route['Admin/Acade/Registration/ExtraSubject'] = "admin/academic/ConAdminExtraSubject";
$route['Admin/Acade/Registration/SettingSystem'] = "admin/academic/ConAdminExtraSubject/SystemMainExtraSubject";
$route['Admin/Acade/Registration/RoomOnline'] = "admin/academic/ConAdminRoomOnline/RoomOnlineMain";

$route['Admin/Acade/Course/SendPlan'] = "admin/academic/ConAdminCourse/SendPlanMain";

$route['Admin/Acade/Report'] = "admin/academic/ConAdminExtraSubject/ExtraReport";

$route['Admin/Acade/Setting/AdminRoles'] = "admin/academic/ConAdminSettingAdminRoles/AcademicSettingAdminRoles";

$route['Admin/Acade/Evaluate/AcademicRepeat/(:any)/(:any)'] = "admin/academic/ConAdminAcademicRepeat/AdminAcademicRepeatMain/$1/$2";
$route['Admin/Acade/Evaluate/AcademicRepeat/(:any)/(:any)/(:any)'] = "admin/academic/ConAdminAcademicRepeat/AdminAcademicRepeatGrade/$1/$2/$3";
$route['Admin/Acade/Evaluate/AcademicResult'] = "admin/academic/ConAdminAcademinResult/AdminAcademinResultMain";
$route['Admin/Acade/Evaluate/EditGrade/(:any)/(:any)'] = "admin/academic/ConAdminEvaluateEditGrade/AdminEvaluateEditGradeMain/$1/$2";
$route['Admin/Acade/Evaluate/EditGrade/(:any)/(:any)/(:any)'] = "admin/academic/ConAdminEvaluateEditGrade/AdminEvaluateEditGradeUpdate/$1/$2/$3";
$route['Admin/Acade/Evaluate/SaveScore'] = "admin/academic/ConAdminSaveScore/AdminSaveScoreMain";
$route['Admin/Acade/Evaluate/SaveScoreGrade/(:any)/(:any)/(:any)'] = "admin/academic/ConAdminSaveScore/AdminSaveScoreGrade/$1/$2/$3";
$route['Admin/Acade/Evaluate/ReportPerson'] = "admin/academic/ConAdminReportResult/AdminReportPersonMain";
$route['Admin/Acade/Evaluate/ReportPerson/(:any)'] = "admin/academic/ConAdminReportResult/AdminStudentsScore/$1";
$route['Admin/Acade/Evaluate/ReportRoom'] = "admin/academic/ConAdminReportResult/AdminReportRoomMain";
$route['Admin/Acade/Evaluate/ReportSummaryTeacher'] = "admin/academic/ConAdminReportResult/AdminReportSummaryTeacher";
$route['Admin/Acade/Evaluate/ReportTeacherSaveScore/(:any)/(:any)'] = "admin/academic/ConAdminReportResult/AdminReportTeacherSaveScoreMain/$1/$2";
$route['Admin/Acade/Evaluate/ReportTeacherSaveScoreCheck/(:any)/(:any)/(:any)'] = "admin/academic/ConAdminReportResult/AdminReportTeacherSaveScoreCheck/$1/$2/$3";
$route['Admin/Acade/Evaluate/ReportScoreRoomMain/(:any)/(:any)/(:any)/(:any)'] = "admin/academic/ConAdminReportResult/ReportScoreRoomMain/$1/$2/$3/$4";

// งานกิจการนักเรียน
$route['Admin/Affairs/StudentSupport/HomeVisit/Setting'] = "admin/Affairs/ConAdminStudentSupport/PageMainSetting";
$route['Admin/Affairs/StudentHomeRoom/SettingSystem'] = "admin/Affairs/ConAdminStudentHomeRoom/PageSettingHomeRoom";
$route['Admin/Affairs/StudentHomeRoom/Dashboard/(:any)'] = "admin/Affairs/ConAdminStudentHomeRoom/PageHomeRoomDashboard/$1";
$route['Admin/Affairs/StudentHomeRoom/ChartHomeRoomAll'] = "admin/Affairs/ConAdminStudentHomeRoom/ChartHomeRoomAll";

// งานบริหารทั่วไป
$route['Admin/General/Personnel/Main'] = "admin/General/ConAdminGeneralPersonnel/PageAdminGeneralMain";
$route['Admin/General/Setting/AdminRoles'] = "admin/General/ConAdminSettingAdminRoles/GeneralSettingAdminRoles";


// ผู้บริหารสถานศึกษา
$route['Admin/Acade/Executive/ReportPerson'] = "admin/academic/ConAdminReportResult/AdminReportPersonMain";
$route['Admin/Acade/Executive/ReportPerson/(:any)'] = "admin/academic/ConAdminReportResult/AdminStudentsScore/$1";
$route['Admin/Acade/Executive/ReportRoom'] = "admin/academic/ConAdminReportResult/AdminReportRoomMain";
$route['Admin/Acade/Executive/ReportSummaryTeacher'] = "admin/academic/ConAdminReportResult/AdminReportSummaryTeacher";
$route['Admin/Acade/Executive/ReportTeacherSaveScore/(:any)/(:any)'] = "admin/academic/ConAdminReportResult/AdminReportTeacherSaveScoreMain/$1/$2";
$route['Admin/Acade/Executive/ReportTeacherSaveScoreCheck/(:any)/(:any)/(:any)'] = "admin/academic/ConAdminReportResult/AdminReportTeacherSaveScoreCheck/$1/$2/$3";
$route['Admin/Acade/Executive/ReportScoreRoomMain/(:any)/(:any)/(:any)/(:any)'] = "admin/academic/ConAdminReportResult/ReportScoreRoomMain/$1/$2/$3/$4";
$route['Admin/Acade/Executive/ReportEnroll/Main'] = "admin/academic/ConAdminReportResult/AdminReportEnrollMain";
$route['Admin/Acade/Executive/ReportEnroll/ID/(:any)'] = "admin/academic/ConAdminReportResult/AdminReportEnrollDetailStudent/$1";


// Login
$route['Logout'] = "Control_login/logout";
$route['LogoutTeacher'] = "Control_login/logoutGoogle";
$route['LoginStudent'] = "Control_login/LoginStudent";
$route['LoginTeacher'] = "Control_login/LoginTeacher";
//$route['LoginTeacher'] = "Control_login/LoginTeacherMain";

$route['LoginMenager'] = "Welcome/LoginMenager";
$route['LoginMenager_callback'] = "Control_login/LoginMenager_callback";


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
$route['StudentsList/Print/(:any)/(:any)/(:any)'] = "user/ConStudents/StudentsPrintRoom/$1/$2/$3";
$route['ClassSchedule'] = "user/ConStudents/ClassSchedule";


$route['LearningOnline'] = "user/ConStudents/LearningOnline";
$route['LearningOnline/(:any)'] = "user/ConStudents/LearningOnlineDetail/$1";

$route['ReportLearnOnline'] = "user/ConStudents/PageReportLearnOnline";