
//---------------------- แดชบอร์ด ---------------------------
const classFilter = new SlimSelect({
    select: '#classFilter',
    showSearch: true, // เปิดให้สามารถค้นหาได้
    allowDeselect: true, // สามารถเลือกได้มากกว่า 1
});

//ดูข้อมูลนักเรียน
$(document).on('click', '.BtnShowStudent', function () {   
    $('#ModalShowStudentRegisterToClub').modal('show');

    $.ajax({
        url: '../../../../admin/academic/ConAdminDevelopStudents/ClubGetClassroom',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            
            var classFilter = $('#classFilter');
            response.classrooms.forEach(function(classroom) {
                classFilter.append('<option value="'+ classroom.StudentClass +'">'+ classroom.StudentClass +'</option>');
            });
        }
    });
});

var TbStudentRegisterClub = $('#TbStudentRegisterClub').DataTable({
    autoWidth: false, // ปิดการตั้งค่าความกว้างอัตโนมัติ
    responsive: true,
    order: [[3, 'asc'], [2, 'asc']],
    ajax: {
        url: '../../../../admin/academic/ConAdminDevelopStudents/ClubGetStudentRegisterClub',
        type: 'GET',
        dataType: 'json',
        data: function(d) {
            d.classFilter = $('#classFilter').val(); // ส่งค่าที่เลือกจาก Dropdown ไป
        }
    },
    columns: [
        { data: 'StudentCode',title: 'รหัสนักเรียน' },
        { data: 'Fullname', title: 'ชื่อ - สกุล' },
        { data: 'StudentNumber', title: 'เลขที่' },
        { data: 'StudentClass', title: 'ห้องเรียน' },
        { data: 'club_status', title: 'สถานะชุมนุม',
            render: function(data, type, row) {
                if (data === 'ยังไม่ได้เลือกชุมนุม') {
                    return `<span class="badge bg-danger">${data}</span>`;
                } else {
                    return `<span class="badge bg-success">${data}</span>`;
                }
            }
         }
    ],
    dom: 'Bfrtip', // เพิ่มปุ่ม
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'ดาวน์โหลด Excel',
                className: 'btn btn-success',
                 title: 'รายงานข้อมูลนักเรียนที่ลงทะเบียนชุมนุม',
                filename:'รายงานข้อมูลนักเรียนที่ลงทะเบียนชุมนุม'
            },
            {
                extend: 'print',
                text: 'พิมพ์รายงาน',
                className: 'btn btn-primary',
                 title: 'รายงานข้อมูลนักเรียนที่ลงทะเบียนชุมนุม',
                filename:'รายงานข้อมูลนักเรียนที่ลงทะเบียนชุมนุม'
            }
        ],
    responsive: true,
    language: {
        url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/th.json" // เพิ่มภาษาไทย
    }
});

// เมื่อเลือกห้องเรียนใหม่
$('#classFilter').on('change', function() {
    TbStudentRegisterClub.ajax.reload(); // รีเฟรชข้อมูล
});

// กำหนดปีการศึกษา
$(document).on('click', '#MenuSetYear', function () { 
    $('#ModalClubSetYear').modal('show');
 });

 $(document).on('submit','#FormClubSetOnoffYear',function (e) {
    e.preventDefault();
    // ดึงค่าจากฟอร์ม
    const c_onoff_term = $('#c_onoff_term').val();
    const c_onoff_year = $('#c_onoff_year').val();

    // ตรวจสอบค่าก่อนส่ง
    if (!c_onoff_term || !c_onoff_year) {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        return;
    }

    // ส่งข้อมูลผ่าน AJAX
    $.ajax({
        url: '../../../../admin/academic/ConAdminDevelopStudents/ClubSetOnoffYear', // ชี้ไปที่ Controller
        type: 'POST',
        dataType: 'json',
        data: {
            c_onoff_term: c_onoff_term,
            c_onoff_year: c_onoff_year
        },
        success: function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: "success",
                    title: "แจ้งเตือน!",
                    text: response.message
                });           
                $('#ModalClubSetYear').modal('hide');
                $('.modal-backdrop').remove();   
            } else {
                Swal.fire({
                    icon: "error",
                    title: "แจ้งเตือน!",
                    text: response.message
                });
            }
        },
        error: function () {
            $('#responseMessage').html(`<div class="alert alert-danger">เกิดข้อผิดพลาดในการบันทึกข้อมูล</div>`);
        }
    });
});

$(document).on('click', '#MenuSetDateRegister', function () { 
    $('#ClubSetDateRegister').modal('show');
    $.ajax({
        url: '../../../../admin/academic/ConAdminDevelopStudents/ClubGetDateRegister', // URL ของ PHP ที่ดึงข้อมูล
        method: 'GET',
        dataType: 'json',
        success: function (response) {

            var c_onoff_regisstart = response.datetime.c_onoff_regisstart;
            var c_onoff_regisend = response.datetime.c_onoff_regisend;

            // แปลงค่าให้เป็น Date Object (เพื่อป้องกันการแปลง Time Zone ผิด)
            var TimeStart = new Date(c_onoff_regisstart);
            var TimeEnd = new Date(c_onoff_regisend);
            // ใช้งาน Flatpickr พร้อมตั้งค่าภาษาไทย
            flatpickr(".thaiDateTimeStart", {
                enableTime: true, // เปิดเลือกเวลา
                dateFormat: "d F Y H:i", // กำหนดรูปแบบวันที่เวลา
                locale: "th", // ตั้งค่าภาษาไทย
                disableMobile: true ,
                defaultDate: TimeStart,
            });

            flatpickr(".thaiDateTimeEnd", {
                enableTime: true, // เปิดเลือกเวลา
                dateFormat: "d F Y H:i", // กำหนดรูปแบบวันที่เวลา
                locale: "th", // ตั้งค่าภาษาไทย
                disableMobile: true ,
                defaultDate: TimeEnd,
            });
        },
        error: function (xhr, status, error) {
            console.error("Error fetching date:", error);
        }
    });


   
 });



$(document).on('submit','#FormClubSetDateRegister',function (e) {
    e.preventDefault();
    // ดึงค่าจากฟอร์ม
    const c_onoff_regisstart = $('#c_onoff_regisstart').val();
    const c_onoff_regisend = $('#c_onoff_regisend').val();

    console.log(c_onoff_regisstart);
    
    // ตรวจสอบค่าก่อนส่ง
    if (!c_onoff_regisstart || !c_onoff_regisend) {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        return;
    }

    // ส่งข้อมูลผ่าน AJAX
    $.ajax({
        url: '../../../../admin/academic/ConAdminDevelopStudents/ClubSetDateRegister', // ชี้ไปที่ Controller
        type: 'POST',
        dataType: 'json',
        data: {
            c_onoff_regisstart: c_onoff_regisstart,
            c_onoff_regisend: c_onoff_regisend
        },
        success: function (response) {
            if (response.status === 'success') {
                Swal.fire({
                    icon: "success",
                    title: "แจ้งเตือน!",
                    text: response.message
                });           
                $('#ClubSetDateRegister').modal('hide');
                $('#FormClubSetDateRegister')[0].reset();
                $('.modal-backdrop').remove();   
            } else {
                Swal.fire({
                    icon: "error",
                    title: "แจ้งเตือน!",
                    text: response.message
                });
            }
        },
        error: function () {
            $('#responseMessage').html(`<div class="alert alert-danger">เกิดข้อผิดพลาดในการบันทึกข้อมูล</div>`);
        }
    });
});


