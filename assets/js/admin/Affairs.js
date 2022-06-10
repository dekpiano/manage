$(document).on("change", "#homevisit_set_manager", function() {
    $.post("../../../../admin/Affairs/ConAdminStudentSupport/HomeVisitSettingManager", { TeachID: $(this).val() }, function(data, status) {
        if (data == 1) {
            alertify.success('เลือกหัวหน้างานสำเร็จ');
        } else {
            alertify.error('เปลี่ยนแปลงข้อมูลไม่สำเร็จ');
        }
    });
});

$(document).on("change", "#set_homeroom_time", function() {
    console.log($(this).val());
    $.post("../../../admin/Affairs/ConAdminStudentHomeRoom/UpdateTimeHomeRoom", { set_homeroom_time: $(this).val() }, function(data, status) {
        if (data == 1) {
            alertify.success('เปลี่ยนเวลาสำเร็จ');
        } else {
            alertify.error('เปลี่ยนเวลาไม่สำเร็จ');
        }
    });
});