// Example starter JavaScript for disabling form submissions if there are invalid fields


var tbErollSubject;
tbErollSubject = $('#tbErollSubject').DataTable({
    "order": [
        [1, "asc"]
    ],
    'processing': true,
    "ajax": {
        url: "../../admin/academic/ConAdminEnroll/AdminEnrollSubject",
        "type": "POST"
    },
    'columns': [
        { data: 'SubjectYear' },
        { data: 'SubjectCode' },
        { data: 'SubjectName' },
        { data: 'FirstGroup' },
        { data: 'SubjectClass' },
        {
            data: 'TeacherName',
            render: function(data, type, row) {
                return data;
            }
        },
        {
            data: 'SubjectID',
            render: function(data, type, row) {
                return '<span class="badge bg-success rounded-pill ShowEnroll" data-bs-toggle="modal" data-bs-target="#staticBackdrop" sub-id="' + row.SubjectID + '" teach-id="' + row.TeacherID + '">ลงทะเบียนแล้ว</span>';
            }
        },
        {
            data: 'SubjectID',
            render: function(data, type, row) {
                return '<a href="../../Admin/Acade/Enroll/Edit/' + row.SubjectID + '/' + row.TeacherID + '" class="btn btn-success btn-sm text-white">เพิ่มรายชื่อ</a>' +
                    ' <a href="../../Admin/Acade/Enroll/Delete/' + row.SubjectID + '/' + row.TeacherID + '" class="btn btn-warning btn-sm">ถอนราชื่อ</a>' +
                    ' <a href="../../Admin/Acade/Enroll/Cancel/' + row.SubjectID + '/' + row.TeacherID + '" class="btn btn-danger btn-sm text-white">ลบลงทะเบียน</a>';
            }
        }
    ]
});


$('#teacherregis').select2({
    width: 300
});
$('#subjectregis').select2({
    width: 300
});
$('#Room').select2({
    width: 300
});
$('#RoomEdit').select2({
    width: 300
});


$(document).on("change", "#Room", function() {

    $('#multiselect option').remove();

    $.post("../../../admin/academic/ConAdminEnroll/AdminEnrollSelect", { KeyRoom: $(this).val() }, function(data, status) {

        $.each(data, function(index, value) {
            //console.log(value);
            // trHTML = '<tr><td></td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + '</td></tr>';
            trHTML = '<option value="' + value.StudentID + '">' + value.StudentClass + ' ' + value.StudentNumber.padStart(2, '0') + ' ' + value.StudentPrefix + value.StudentFirstName + ' ' + value.StudentLastName + '</option>';
            $('#multiselect').append(trHTML);
        });
    }, 'json');

});

$(document).on("change", "#RoomEdit", function() {

    $('#multiselect option').remove();

    $.post("../../../../../admin/academic/ConAdminEnroll/AdminEnrollSelect", { KeyRoom: $(this).val() }, function(data, status) {

        $.each(data, function(index, value) {
            //console.log(value);
            // trHTML = '<tr><td></td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + '</td></tr>';
            trHTML = '<option value="' + value.StudentID + '">' + value.StudentClass + ' ' + value.StudentNumber.padStart(2, '0') + ' ' + value.StudentPrefix + value.StudentFirstName + ' ' + value.StudentLastName + '</option>';
            $('#multiselect').append(trHTML);
        });


    }, 'json');

});


$(document).on("submit", "#FormEnroll", function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../../admin/academic/ConAdminEnroll/AdminEnrollInsert',
        type: 'post',
        data: $(this).serialize(),
        error: function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'นักเรียนในรายชื่อนี้ได้ลงทะเบียนวิชานี้ และปีนี้ไปแล้ว กรุณาเลือกและตรวจสอบใหม่',
                showConfirmButton: false,
                timer: 3000
            })
        },
        success: function(data) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'บันทึกข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 3000
            })
        }
    });
});

$(document).on("submit", "#FormEnrollUpdate", function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../../../../admin/academic/ConAdminEnroll/AdminEnrollUpdate',
        type: 'post',
        data: $(this).serialize(),
        error: function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'นักเรียนในรายชื่อนี้ได้ลงทะเบียนวิชานี้ และปีนี้ไปแล้ว กรุณาเลือกและตรวจสอบใหม่',
                showConfirmButton: false,
                timer: 3000
            })
        },
        success: function(data) {
            // console.log(data);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'เพิ่งรายชื่อนักเรียนสำเร็จ',
                showConfirmButton: false,
                timer: 3000
            })
        }
    });
});

$(document).on("submit", "#FormEnrollDelete", function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../../../../admin/academic/ConAdminEnroll/AdminEnrollDel',
        type: 'post',
        data: $(this).serialize(),
        error: function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'นักเรียนในรายชื่อนี้ได้ลงทะเบียนวิชานี้ และปีนี้ไปแล้ว กรุณาเลือกและตรวจสอบใหม่',
                showConfirmButton: false,
                timer: 3000
            })
        },
        success: function(data) {
            // console.log(data);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'ถอนการลงทะเบียนรายวิชาสำเร็จ',
                showConfirmButton: false,
                timer: 3000
            })
        }
    });
});


$(document).on("click", ".ShowEnroll", function() {

    $('#tb_ShowEnroll tbody tr').remove();

    $.post("../../admin/academic/ConAdminEnroll/AdminEnrollShow", {
        subid: $(this).attr('sub-id'),
        teachid: $(this).attr('teach-id')
    }, function(data, status) {
        //console.log(data);
        $('.ShowSubjectName').html("วิชา " + data[0].SubjectName + "<br>ครูผู้สอน " + data[0].pers_prefix + data[0].pers_firstname + ' ' + data[0].pers_lastname);
        $.each(data, function(index, value) {
            $('#tb_ShowEnroll tbody').append('<tr class="DelTableRow"><td>' + value.StudentClass + '</td><td>' + value.StudentNumber + '</td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix + value.StudentFirstName + ' ' + value.StudentLastName + '</td></tr>');
        });
    }, 'json');


});