// Submit form data via Ajax
$(document).on('submit', '#form_insert_plan', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '../../teacher/ConTeacherCourse/insert_plan',
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function() {
            $('.submitBtn').attr("disabled", "disabled");
        },
        success: function(response) {
            //console.log(response);
            if (response == 1) {
                //$('#form_insert_plan')[0].reset();
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: "คุณลงทะเบียนวิชาเรียบร้อยแล้ว",
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../../Teacher/Course";
                    }
                })
            } else if (response == 2) {
                Swal.fire({
                    title: 'แจ้งเตือน',
                    text: "คุณได้ลงทะเบียนวิชานี้ไว้แล้ว",
                    icon: 'warning',
                    confirmButtonText: 'ตกลง'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../../Teacher/Course";
                    }
                })
            } else {
                console.log(response);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus);
        }
    });
});

$('.update_seplan').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../teacher/ConTeacherCourse/UpdatePlan',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            console.log(data);
            if (data > 0) {
                $('#ModalUpdatePlan').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })
            } else {
                window.location.reload();
            }
        }
    });
});

$(document).on('click', '.Model_update', function() {
    $('#seplan_ID').val($(this).attr('seplanID'));
    $('#seplan_coursecode').val($(this).attr('seplanCoursecode'));
    $('#seplan_typeplan').val($(this).attr('seplanTypeplan'));
    $('#seplan_sendcomment').html($(this).attr('seplan_sendcomment'));

});


$('.ConfrimStatus').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../teacher/ConTeacherStudentSupport/confrim_statuslevelhead',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {

            if (data) {
                if (data[1] == 'ผ่าน') {
                    $('#s_homevisit_statuslevelhead' + data[0]).addClass('is-valid');
                    $('#s_homevisit_statuslevelhead' + data[0]).removeClass('is-invalid');
                } else {
                    $('#s_homevisit_statuslevelhead' + data[0]).addClass('is-invalid');
                    $('#s_homevisit_statuslevelhead' + data[0]).removeClass('is-valid');
                }

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // window.location.reload();
                    }
                })



            }
        }
    });
});

$('.ConfrimStatusManager').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../teacher/ConTeacherStudentSupport/confrim_statusmanager',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {

            if (data) {
                if (data[1] == 'ผ่าน') {
                    $('#s_homevisit_statusmanager' + data[0]).addClass('is-valid');
                    $('#s_homevisit_statusmanager' + data[0]).removeClass('is-invalid');
                } else {
                    $('#s_homevisit_statusmanager' + data[0]).addClass('is-invalid');
                    $('#s_homevisit_statusmanager' + data[0]).removeClass('is-valid');
                }

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // window.location.reload();
                    }
                })



            }
        }
    });
});


$(document).on("change", "#homevisit_set_onoff", function() {
    //alert($(this).prop('checked'));
    $.post("../../teacher/ConTeacherStudentSupport/Setting_Helpstd_OnOff", { onoff: $(this).prop('checked') }, function(data, status) {
        if (data == 1) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'เปลี่ยนแปลงสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // window.location.reload();
                }
            })
        } else {
            alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
        }
    });
});