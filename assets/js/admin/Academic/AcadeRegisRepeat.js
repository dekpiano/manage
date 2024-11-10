// Example starter JavaScript for disabling form submissions if there are invalid fields

let tbRegisRepeatSubject;
TB_RegisRepeatSubject($('#schyear_year').val());
$(document).on('change', '#CheckYearRegisRepeat', function() {
    //alert($(this).val());
    TB_RegisRepeatSubject($(this).val());
});

function TB_RegisRepeatSubject(Year) {
    tbRegisRepeatSubject = $('#tbRegisRepeatSubject').DataTable({
        destroy: true,
        "order": [
            [7, "desc"]
        ],
        'processing': true,
        "ajax": {
            url: "../../../admin/academic/ConAdminRegisRepeat/AdminRegisRepeatShow",
            "type": "POST",
            data: { "keyYear": Year }
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
                    return '<a class="btn-sm app-btn-primary" href="Repeat/Detail/' + row.SubjectYear + '/' + row.SubjectCode + '/' + row.TeacherID +'">ลงทะเบียนเรียนซ้ำ</a>';
                }
            },
            {
                data: 'SumRepeat',
                render: function(data, type, row) {
                    return '<span class="badge bg-warning text-black-50">' +data +' คน </span>';
                }
            }
        ]
    });
}


// $('#SelectYearRegister').select2({
//     width: 300
// });

// $('#teacherregis').select2({
//     width: 300
// });
// $('#subjectregis').select2({
//     width: 300
// });
// $('#Room').select2({
//     width: 300
// });
// $('#RoomEdit').select2({
//     width: 300
// });

// $('#RepeatTeacher').select2({

// });

$(document).on("change", "#SelectYearRegister", function() {
    window.location.href = '../' + $(this).val();
});


$(document).on("change", "#Room", function() {

    $('#multiselect option').remove();

    $.post("../../../../../../admin/academic/ConAdminRegisRepeat/AdminRegisRepeatSelect", { KeyRoom: $(this).val() }, function(data, status) {

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

    $.post("../../../../../../admin/academic/ConAdminRegisRepeat/AdminRegisRepeatSelect", { KeyRoom: $(this).val() }, function(data, status) {

        $.each(data, function(index, value) {
            //console.log(value);
            // trHTML = '<tr><td></td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix+value.StudentFirstName+' '+value.StudentLastName + '</td></tr>';
            trHTML = '<option value="' + value.StudentID + '">' + value.StudentClass + ' ' + value.StudentNumber.padStart(2, '0') + ' ' + value.StudentPrefix + value.StudentFirstName + ' ' + value.StudentLastName + '</option>';
            $('#multiselect').append(trHTML);
        });


    }, 'json');

});


// $(document).on("submit", "#FormRegisRepeat", function(e) {
//     e.preventDefault();
//     $.ajax({
//         url: '../../../../../../admin/academic/ConAdminRegisRepeat/AdminRegisRepeatInsert',
//         type: 'post',
//         data: $(this).serialize(),
//         error: function() {
//             Swal.fire({
//                 position: 'top-end',
//                 icon: 'error',
//                 title: 'นักเรียนในรายชื่อนี้ได้ลงทะเบียนวิชานี้ และปีนี้ไปแล้ว กรุณาเลือกและตรวจสอบใหม่',
//                 showConfirmButton: false,
//                 timer: 3000
//             })
//         },
//         success: function(data) {
//             Swal.fire({
//                 position: 'top-end',
//                 icon: 'success',
//                 title: 'บันทึกข้อมูลสำเร็จ',
//                 showConfirmButton: false,
//                 timer: 3000
//             })
//         }
//     });
// });

$(document).on("submit", "#FormRegisRepeatUpdate", function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../../../../../../admin/academic/ConAdminRegisRepeat/AdminRegisRepeatAdd',
        type: 'post',
        data: $(this).serialize(),
        error: function() {
            //console.log(data);
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'ระบบผิดพลาด ลองใหม่อีกครั้ง!',
                showConfirmButton: false,
                timer: 3000
            })
        },
        success: function(data) {
            console.log(data);
            if (data === "สำเร็จ") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'ลงทะเบียนเรียนซ้ำ สำเร็จ!',
                    showConfirmButton: false,
                    timer: 3000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload(true);
                    }
                });

            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'คุณไม่ได้เลือกนักเรียนในการลงทะเบียนเรียนซ้ำ!',
                    showConfirmButton: false,
                    timer: 3000
                })
            }

        }
    });
});

// $(document).on("submit", "#FormRegisRepeatDelete", function(e) {
//     e.preventDefault();
//     Swal.fire({
//         title: 'ต้องการถอนรายชื่อในการลงทะเบียนหรือไม่?',
//         text: 'เมื่อถอนรายชื่อการลงทะเบียนวิชานี้แล้ว คะแนนและรายชื่อนักเรียนในวิชานี้ จะถูกลบทั้งหมด',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: '../../../../../../admin/academic/ConAdminRegisRepeat/AdminRegisRepeatDel',
//                 type: 'post',
//                 data: $(this).serialize(),
//                 error: function() {
//                     Swal.fire({
//                         position: 'top-end',
//                         icon: 'error',
//                         title: 'นักเรียนในรายชื่อนี้ได้ลงทะเบียนวิชานี้ และปีนี้ไปแล้ว กรุณาเลือกและตรวจสอบใหม่',
//                         showConfirmButton: false,
//                         timer: 3000
//                     })
//                 },
//                 success: function(data) {
//                     // console.log(data);
//                     Swal.fire({
//                         position: 'top-end',
//                         icon: 'success',
//                         title: 'ถอนการลงทะเบียนรายวิชาสำเร็จ',
//                         showConfirmButton: false,
//                         timer: 3000
//                     })
//                 }
//             });
//         }
//     })
// });


// $(document).on("click", ".ShowRegisRepeat", function() {

//     $('#tb_ShowRegisRepeat tbody tr').remove();

//     $.post("../../../admin/academic/ConAdminRegisRepeat/AdminRegisRepeatShow", {
//         subid: $(this).attr('sub-id'),
//         teachid: $(this).attr('teach-id')
//     }, function(data, status) {
//         //console.log(data);
//         $('.ShowSubjectName').html("วิชา " + data[0].SubjectName + "<br>ครูผู้สอน " + data[0].pers_prefix + data[0].pers_firstname + ' ' + data[0].pers_lastname);
//         $.each(data, function(index, value) {
//             $('#tb_ShowRegisRepeat tbody').append('<tr class="DelTableRow"><td>' + value.StudentClass + '</td><td>' + value.StudentNumber + '</td><td>' + value.StudentCode + '</td><td>' + value.StudentPrefix + value.StudentFirstName + ' ' + value.StudentLastName + '</td></tr>');
//         });
//     }, 'json');

// });

// $(document).on("click", ".CancelRegisRepeat", function() {
//     console.log($(this).attr('key-teacher'));
//     Swal.fire({
//         title: 'ต้องการลบการลงทะเบียนหรือไม่?',
//         text: 'เมื่อลบการลงทะเบียนวิชานี้แล้ว คะแนนและรายชื่อนักเรียนในวิชานี้ จะถูกลบทั้งหมด',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $(this).parents('tr').remove();

//             $.post("../../../admin/academic/ConAdminRegisRepeat/AdminRegisRepeatCancel", {
//                 KeyTeacher: $(this).attr('key-teacher'),
//                 KeySubject: $(this).attr('key-subject')
//             }, function(data, status) {
//                 console.log(data);

//             });

//             Swal.fire(
//                 'ลบข้อมูลเรียบร้อย!',
//                 'Your data has been deleted.',
//                 'success'
//             )
//         }
//     })
// });