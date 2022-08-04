$(document).on("change", ".onoff_savescore", function() {

    // console.log($(this).prop('checked'));
    //console.log($(this).val());
    // console.log($(this).attr('onoff-id'));

    $.post("../../admin/academic/ConAdminSaveScore/CheckOnOffSaveScore", {
            check: $(this).prop('checked'),
            key: $(this).attr('onoff-id'),
            value: $(this).val()
        },
        function(data, status) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'เปลี่ยนแปลงข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 3000
            })
        });
})