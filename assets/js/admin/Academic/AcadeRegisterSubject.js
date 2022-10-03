var tablel_Subject;
tablel_Subject = $('#tbSubject').DataTable({
    "order": [
        [1, "asc"]
    ],
    'processing': true,
    "ajax": {
        url: "../../../admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectSelect",
        "type": "POST"
    },
    'columns': [
        { data: 'SubjectYear' },
        { data: 'SubjectCode' },
        { data: 'SubjectName' },
        { data: 'FirstGroup' },
        { data: 'SubjectClass' },
        { data: 'SubjectYear' },
        {
            data: 'SubjectID',
            render: function(data, type, row) {
                return '<a href="#" idSbuj="' + data + '" class="btn btn-warning btn-sm EditSubject"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">แก้ไข</a> | <a href="#" idSbuj="' + data + '" class="btn btn-danger btn-sm delete_subject text-white">ลบ</a>';

            }
        }
    ]
});

$(document).on('click', '.EditSubject', function() {
    $.ajax({
        url: '../../../admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectEdit',
        type: 'post',
        data: { KeySubj: $(this).attr('idSbuj') },
        dataType: 'json',
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            console.log(data[0]);
            $('#Up_SubjectYear').val(data[0].SubjectYear);
            $('#Up_SubjectClass').val(data[0].SubjectClass);
            $('#Up_SubjectCode').val(data[0].SubjectCode);
            $('#Up_SubjectName').val(data[0].SubjectName);
            $('#Up_SubjectUnit').val(data[0].SubjectUnit);
            $('#Up_SubjectHour').val(data[0].SubjectHour);
            $('#Up_SubjectType').val(data[0].SubjectType);
            $('#Up_FirstGroup').val(data[0].FirstGroup);
            $('#Up_SecondGroup').val(data[0].SecondGroup);
            $('#Up_SubjectID').val(data[0].SubjectID);

        }
    });
});


$(document).on('submit', '#form-subject', function(e) {
    e.preventDefault();
    //console.log($(this).serialize());

    $.ajax({
        url: '../../../admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectInsert',
        type: 'post',
        data: $(this).serialize(),
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            console.log(data);
            if (data > 0) {
                $('#form-subject')[0].reset();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 3000
                })
                tablel_Subject.ajax.reload();
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'ข้อมูลรายวิชานี้ ได้ลงทะเบียนในภาคเรียนนี้แล้ว',
                    showConfirmButton: false,
                    timer: 5000
                })
            }

        }
    });
});

$(document).on('submit', '#form-update-subject', function(e) {
    e.preventDefault();
    //console.log($(this).serialize());

    $.ajax({
        url: '../../../admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectUpdate',
        type: 'post',
        data: $(this).serialize(),
        error: function() {
            alert('Something is wrong');
        },
        success: function(data) {
            $('#staticBackdrop').hide();
            if (data > 0) {
                $('#form-update-subject')[0].reset();
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'แก้ไขข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 3000
                })
                tablel_Subject.ajax.reload();
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'ข้อมูลรายวิชานี้ ได้ลงทะเบียนในภาคเรียนนี้แล้ว',
                    showConfirmButton: false,
                    timer: 5000
                })
            }

        }
    });
});


$(document).on('click', '.delete_subject', function() {
    var id = $(this).attr("idSbuj");

    Swal.fire({
        title: 'Are you sure?',
        text: "คุณต้องการลลข้อมูลหรือไม่!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '../../../admin/academic/ConAdminRegisterSubject/AdminRegisterSubjectDelete/' + id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'ลบข้อมูลสำเร็จ',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    tablel_Subject.ajax.reload();
                }
            });
        }
    })
});