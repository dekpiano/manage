// Submit form data via Ajax
$(document).on('submit', '#form_insert_plan', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '../../teacher/ConTeacherCourse/insert_plan',
        data: new FormData(this),
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function() {
            $('.submitBtn').attr("disabled", "disabled");
        },
        success: function(response) {
            //console.log(response[0][0].seplan_coursecode);
            if (response == 2) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'คุณได้ลงทะเบียนวิชานี้ในเทมอนี้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.isConfirmed) {
                        //  window.location.href = "../../Teacher/Course";
                    }
                })
            } else if (response[0][0].seplan_coursecode == $('#seplan_coursecode').val()) {
                var markup = "<tr><td>" + response[0][0].seplan_year + "/" + response[0][0].seplan_term + "</td><td>" + response[0][0].seplan_coursecode + "</td><td>" + response[0][0].seplan_namesubject + "</td><td>ม." + response[0][0].seplan_gradelevel + "</td><td>" + response[0][0].seplan_typesubject + "</td><td>" + response[0][0].pers_prefix + response[0][0].pers_firstname + ' ' + response[0][0].pers_lastname + "</td></tr>";
                $("#TableShoowPlan tbody").prepend(markup);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'คุณลงทะเบียนวิชาเรียบร้อยแล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.isConfirmed) {

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


$(document).on("click", ".EditTeach", function() {
    $.post("../../teacher/ConTeacherCourse/setting_teacher_eidt", { PlanCode: $(this).attr('PlanCode') }, function(data, status) {
        $('#up_seplan_coursecode').val(data[0].seplan_coursecode);
        $('#up_seplan_namesubject').val(data[0].seplan_namesubject);
        $('#up_seplan_gradelevel').val(data[0].seplan_gradelevel);
        $('#up_seplan_typesubject').val(data[0].seplan_typesubject);
        $('#up_seplan_usersend').val(data[0].seplan_usersend);
    }, "json");
});

$('#FromUpdateTeacher').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../teacher/ConTeacherCourse/setting_teacher_update',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            console.log(data);
            if (data > 0) {
                $('#editteacher').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'แก้ไขข้อมูลสำเร็จ',
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

////////////---------------------------------------------
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


$(document).on("change", ".seplan_status1", function() {

    var status1 = $(this).val();
    var planId = $(this).attr('data-planId');

    $.ajax({
        type: 'POST',
        url: "../../../teacher/ConTeacherCourse/UpdateStatus1",
        data: { status1: status1, planId: planId },
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(data) {
            console.log(data[0].seplan_status1);

            if (data[0].seplan_status1 == "ผ่าน") {
                $(".bgC" + planId).addClass('text-success');
                $(".bgC" + planId).removeClass('text-danger');
                $('.IDCom0' + planId).html('');
            }

            if (data[0].seplan_status1 == "ไม่ผ่าน") {
                $(".bgC" + planId).addClass('text-danger');
                $(".bgC" + planId).removeClass('text-success');
                $('.IDCom0' + planId).html('<a href="#" class="show_comment1" data-toggle="modal" data-planId="' + planId + '" data-target="#addcomment1">หมายเหตุ</a>');
            }
            if (data[0].seplan_status1 == "ผ่าน") {
                $('#bgC' + planId + ' .TbShowComment1').html('');
            }
            $(".form-comment1")[0].reset();

            alertify.set('notifier', 'position', 'top-right');
            alertify.success('เปลี่ยนสถานะสำเร็จ');

        },
        error: function(xhr) {
            alert("Error occured.please try again");
            console.log(xhr.statusText + xhr.responseText);
        }
    });
});

$(document).on("change", ".seplan_status2", function() {
    // console.log($(this).val());
    // console.log($(this).attr('data-planId'));
    var status2 = $(this).val();
    var planId = $(this).attr('planId');

    $.ajax({
        type: 'POST',
        url: "../../../teacher/ConTeacherCourse/UpdateStatus2",
        data: { status2: status2, planId: planId },
        dataType: 'json',
        cache: false,
        beforeSend: function() {

        },
        success: function(data) {

            if (data[0].seplan_status2 == "ผ่าน") {
                $(".bgCC" + planId).addClass('text-success');
                $(".bgCC" + planId).removeClass('text-danger');
                $('.IDCom' + planId).html('');
            }

            if (data[0].seplan_status2 == "ไม่ผ่าน") {
                $(".bgCC" + planId).addClass('text-danger');
                $(".bgCC" + planId).removeClass('text-success');
                $('.IDCom' + planId).html('<a href="#" class="show_comment2" data-toggle="modal" data-planId="' + planId + '" data-target="#addcomment2">หมายเหตุ</a>');
            }

            $(".form-comment2")[0].reset();

            alertify.set('notifier', 'position', 'top-right');
            alertify.success('เปลี่ยนสถานะสำเร็จ');

        },
        error: function(xhr) {
            alert("Error occured.please try again");
            console.log(xhr.statusText + xhr.responseText);
        }
    });
});