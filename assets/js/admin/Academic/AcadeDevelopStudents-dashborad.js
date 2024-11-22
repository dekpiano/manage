
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



