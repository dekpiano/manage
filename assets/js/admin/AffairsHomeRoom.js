$('#ShowDashborad').DataTable({
    paging: false,
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5', 'excelHtml5', 'print'
    ],
    "autoWidth": true,
    "footerCallback": function(row, data, start, end, display) {
        var api = this.api();
        nb_cols = api.columns().nodes().length;
        var j = 1;
        while (j < nb_cols) {
            var pageTotal = api
                .column(j)
                .data()
                .reduce(function(a, b) {
                    return Number(a) + Number(b);
                }, 0);
            // Update footer
            $(api.column(j).footer()).html(pageTotal);
            j++;
        }
    }
});

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

$(document).on("change", "#show_date", function() {
    console.log($(this).val());
    window.location.href = $(this).val();
});