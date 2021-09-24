// เพิ่มไฟล์เยื่ยมบ้าน
$('.add_filecoversheet').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../teacher/ConTeacherStudentSupport/Add_filecoversheet',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })


            }
        }
    });
});

$('.add_homevisit_fileSDQ').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../teacher/ConTeacherStudentSupport/Add_homevisit_fileSDQ',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })


            }
        }
    });
});

$('.add_homevisit_filerecordform').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../teacher/ConTeacherStudentSupport/Add_homevisit_filerecordform',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })


            }
        }
    });
});

$('.add_homevisit_filesummary').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../teacher/ConTeacherStudentSupport/Add_homevisit_filesummary',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })


            }
        }
    });
});

$('.ConfrimStatus').change(function(e) {
    e.preventDefault();
    $.ajax({
        url: '../teacher/ConTeacherStudentSupport/confrim_status',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            if (data > 0) {
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