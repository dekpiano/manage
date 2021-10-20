$(document).ready(function() {

    var ta = $('#tb-classroom').DataTable({
        "order": [
            [0, "desc"],
            [1, "asc"]
        ]
    });

    var ta = $('#ReportExtraSubject').DataTable({
        "order": [
            [3, "asc"],
            [4, "asc"]
        ]
    });

    $('#AddClassRoom').on('submit', function(e) {
        e.preventDefault();
        var formadd = $('#AddClassRoom').serialize();
        $.ajax({
            type: 'post',
            url: "../../admin/ConAdminClassRoom/AddClassRoom",
            data: formadd,
            beforeSend: function() {
                console.log("กำลังโหลด");
            },
            complete: function() {
                //console.log("คือไรว่ะ");
            },
            success: function(result) {
                $('#myModal').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })

            }
        });

    });



    // update plan
    $(document).on('submit', '#form_update_plan', function(e) {
        var $this = $('button[type="submit"]');
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../../../teacher/ConTeacherCourse/update_plan',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function() {

                var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> กำลังส่ง...';
                $this.html(loadingText);

            },
            success: function(response) { //console.log(response);
                if (response == 1) {
                    //$('#form_insert_plan')[0].reset();
                    Swal.fire({
                        title: 'แจ้งเตือน',
                        text: "คุณส่งงานเรียบร้อยแล้ว",
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../../../Teacher/Course";
                        }
                    })

                } else {
                    console.log(response);
                    var loadingText = 'ส่งงาน';
                    $this.html(loadingText);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                var loadingText = 'ส่งงาน';
                $this.html(loadingText);
            }
        });
    });


    $(document).on('click', '.delete_plan', function() {
        var id = $(this).parents("tr").attr("id");
        //alert(id);
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
                    url: '../Teacher/Course/Delete/' + id,
                    type: 'DELETE',
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {
                        $("#" + id).remove();
                        Swal.fire(
                            'Deleted!',
                            'คุณลบไฟล์สำเร็จ',
                            'success'
                        )
                    }
                });
            }
        })
    });





    // File type validation
    // $("#seplan_file").change(function() {
    //     var file = this.files[0];
    //     var fileType = file.type;
    //     var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    //     if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
    //         alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
    //         $("#file").val('');
    //         return false;
    //     }
    // });







    $(document).on("click", ".show_comment1", function() {
        var planId = $(this).attr('data-planId');
        //console.log(planId);
        $.ajax({
            type: 'POST',
            url: "../../../teacher/ConTeacherCourse/CheckComment1",
            data: { planId: planId },
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {

                $('textarea.seplan_comment1').html(data[0].seplan_comment1);
                $('#sub_comment1').attr('data-planId', planId);

            },
            error: function(xhr) {
                alert("Error occured.please try again");
                console.log(xhr.statusText + xhr.responseText);
            }
        });
    });

    $(document).on("click", "#sub_comment1", function() {
        var planId = $(this).attr('data-planId');
        var seplan_comment1 = $('#seplan_comment1').val();

        $.ajax({
            type: 'POST',
            url: "../../../teacher/ConTeacherCourse/UpdateComment1",
            data: { planId: planId, seplan_comment1: seplan_comment1 },
            beforeSend: function() {

            },
            success: function(data) {

                if (data == 1) {
                    Swal.fire(
                        'แจ้งเตือน',
                        'คุณเพิ่มหมายเหตุเรียบร้อย',
                        'success'
                    )
                }
                $(".form-comment1")[0].reset();
                $("#addcomment1").modal('hide');
            },
            error: function(xhr) {
                alert("Error occured.please try again");
                console.log(xhr.statusText + xhr.responseText);
            }
        });
    });


    $(document).on("click", ".show_comment2", function() {
        var planId = $(this).attr('data-planId');

        $.ajax({
            type: 'POST',
            url: "../../../teacher/ConTeacherCourse/CheckComment2",
            data: { planId: planId },
            dataType: 'json',
            cache: false,
            beforeSend: function() {

            },
            success: function(data) {

                $('textarea.seplan_comment2').html(data[0].seplan_comment2);
                $('#sub_comment2').attr('data-planId', planId);

            },
            error: function(xhr) {
                alert("Error occured.please try again");
                console.log(xhr.statusText + xhr.responseText);
            }
        });
    });

    $(document).on("click", "#sub_comment2", function() {
        var planId = $(this).attr('data-planId');
        var seplan_comment2 = $('#seplan_comment2').val();

        $.ajax({
            type: 'POST',
            url: "../../../teacher/ConTeacherCourse/UpdateComment2",
            data: { planId: planId, seplan_comment2: seplan_comment2 },
            beforeSend: function() {

            },
            success: function(data) {

                if (data == 1) {
                    Swal.fire(
                        'แจ้งเตือน',
                        'คุณเพิ่มหมายเหตุเรียบร้อย',
                        'success'
                    )
                }
                $(".form-comment2")[0].reset();
                $("#addcomment2").modal('hide');
            },
            error: function(xhr) {
                alert("Error occured.please try again");
                console.log(xhr.statusText + xhr.responseText);
            }
        });
    });
    // ----------------------------วิชาเพิ่มติม-----------------------------------
    $('#ModalAddExtraSubject').on('click', function() {
        $('#myModal').modal('show');
        $("#UpdateExtraSubject").attr('id', "AddExtraSubject");
        $("#AddExtraSubject")[0].reset();
    });

    const slim = new SlimSelect({
        select: '.multiple'
    })
    const slimTeacher = new SlimSelect({
        select: '.single'
    })

    $('.ModalExtraSubject').on('click', function(e) {
        e.preventDefault();
        $('#myModal').modal('show');
        $('.extra_grade_level').prop('checked', false);
        $.ajax({
            type: 'POST',
            url: "../../admin/ConAdminExtraSubject/EditExtraSubject",
            data: { Extraid: $(this).attr('Extraid') },
            dataType: "json",
            beforeSend: function() {

            },
            success: function(data) {
                //console.log(data[0].extra_year);
                $('#extra_id').val(data[0].extra_id);
                $('#extra_year').val(data[0].extra_year);
                $('#extra_term').val(data[0].extra_term);
                $('#extra_key_room').val(data[0].extra_key_room);
                ''
                $('#extra_course_code').val(data[0].extra_course_code);
                $('#extra_course_name').val(data[0].extra_course_name);
                $('#extra_course_teacher').val(data[0].extra_course_teacher);
                $('#extra_number_students').val(data[0].extra_number_students);
                $('#extra_comment').val(data[0].extra_comment);
                var n = data[0].extra_grade_level.split('|');
                slim.set(n);
                slimTeacher.set(data[0].extra_course_teacher);

                $("#AddExtraSubject").attr('id', "UpdateExtraSubject");
            },
            error: function(xhr) {
                alert("Error occured.please try again");
                console.log(xhr.statusText + xhr.responseText);
            }
        });
    });

    $(document).on("submit", "#AddExtraSubject", function(e) {
        e.preventDefault();
        var formadd = $('#AddExtraSubject').serialize();
        $.ajax({
            type: 'POST',
            url: "../../admin/ConAdminExtraSubject/AddExtraSubject",
            data: formadd,
            beforeSend: function() {

            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire(
                        'แจ้งเตือน',
                        'คุณเพิ่มวิชาเพิ่มเติมเรียบร้อย',
                        'success'
                    )
                    Swal.fire({
                        title: 'แจ้งเตือน',
                        text: "คุณเพิ่มวิชาเพิ่มเติมเรียบร้อย",
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })
                }
            },
            error: function(xhr) {
                alert("Error occured.please try again");
                console.log(xhr.statusText + xhr.responseText);
            }
        });
    });

    $(document).on("submit", "#UpdateExtraSubject", function(e) {
        e.preventDefault();
        var formadd = $('#UpdateExtraSubject').serialize();

        $.ajax({
            type: 'POST',
            url: "../../admin/ConAdminExtraSubject/UpdateExtraSubject",
            data: formadd,
            beforeSend: function() {

            },
            success: function(data) {
                console.log(data);
                if (data == 1) {

                    Swal.fire(
                        'แจ้งเตือน',
                        'คุณเพิ่มวิชาเพิ่มเติมเรียบร้อย',
                        'success'
                    )
                    Swal.fire({
                        title: 'แจ้งเตือน',
                        text: "คุณแก้ไขวิชาเพิ่มเติมเรียบร้อย",
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })
                }
            },
            error: function(xhr) {
                alert("Error occured.please try again");
                console.log(xhr.statusText + xhr.responseText);
            }
        });
    });

});

$(document).on("change", "#extra_setting_onoff", function() {
    $.post("../../admin/ConAdminExtraSubject/ExtraSettingOnoff", { onoff: $(this).prop('checked') }, function(data, status) {
        if (data == 1) {
            alertify.success('เปลี่ยนแปลงข้อมูลเปิด - ปิดระบบสำเร็จ');
        } else {
            alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
        }
    });
});

$(document).on("change", "#extra_setting_term", function() {
    $.post("../../admin/ConAdminExtraSubject/ExtraSettingTerm", { Term: $(this).val() }, function(data, status) {
        if (data == 0) {
            alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
        } else {
            alertify.success('คุณเปลี่ยนภาคเรียน ' + data + ' เรียบร้อย');
        }
    });
});

$(document).on("change", "#extra_setting_year", function() {
    $.post("../../admin/ConAdminExtraSubject/ExtraSettingYear", { Year: $(this).val() }, function(data, status) {
        if (data == 0) {
            alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
        } else {
            alertify.success('คุณเปลี่ยนภาคเรียน ' + data + ' เรียบร้อย');
        }
    });
});

$(document).on("change", "#extra_setting_datestart", function() {
    $.post("../../admin/ConAdminExtraSubject/ExtraSettingDateStart", { DateStart: $(this).val() }, function(data, status) {
        console.log(data);
        if (data == 0) {
            alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
        } else {
            alertify.success('คุณเปลี่ยนวันเริ่มต้นเป็น ' + data + ' เรียบร้อย');
        }
    });
});

$(document).on("change", "#extra_setting_dateend", function() {
    $.post("../../admin/ConAdminExtraSubject/ExtraSettingDateEnd", { DateEnd: $(this).val() }, function(data, status) {
        console.log(data);
        if (data == 0) {
            alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
        } else {
            alertify.success('คุณเปลี่ยนวันสิ้นสุดเป็น ' + data + ' เรียบร้อย');
        }
    });
});