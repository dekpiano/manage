$('.SelectTeacher').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});
$('.SelectSubject').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
});

$('#TbSendPlan').DataTable();


$('#FormUpdateSendPlan').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../../admin/academic/ConAdminCourse/UpdateSendPlanTeacher',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function() {
            $('.BtnUpdateSendPlan').attr("disabled", "disabled");
        },
        success: function(data) {
            console.log(data);
            if (data > 0) {
                $('#editteacher').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        //window.location.reload();
                    }
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'รายวิชานี้ ได้เพิ่มลงระบบแล้ว',
                    showConfirmButton: false,
                    timer: 3000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })

            }
        }
    });
});

$('#FormSettingSendPlan').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../../../admin/academic/ConAdminCourse/UpdateSettingSendPlan',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        beforeSend: function() {
            // $('.BtnUpdateSendPlan').attr("disabled", "disabled");
        },
        success: function(data) {
            console.log(data);
            if (data > 0) {
                $('#editteacher').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'อัพเดตข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'รายวิชานี้ ได้เพิ่มลงระบบแล้ว',
                    showConfirmButton: false,
                    timer: 3000
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })

            }
        }
    });
});