$(document).on("click", ".ShowStudent", function() {
    $('#ShowStudent').modal('show');
    $('.DelTableRow').remove();
    $.post('../../teacher/ConTeacherTeaching/CHR_CheckStudent', {
            id: $(this).attr('homeroom-id'),
            keyword: $(this).attr('homeroom-keyword')
        }, function(data) {
            //console.log(data);

            $.each(data, function(key, val) {
                console.log(val[0].StudentFirstName);
                $('#TB_showstudent').append('<tr class="DelTableRow"><td>' + val[0].StudentNumber + '</td><td>' + val[0].StudentCode + '</td><td>' + val[0].StudentPrefix + val[0].StudentFirstName + ' ' + val[0].StudentLastName + '</td></tr>');
            });


        }, 'json')
        .fail(function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
        });
});

$(document).on("submit", ".Add_RoomOnline", function(e) {
    e.preventDefault(e);
    $.ajax({
        url: '../../teacher/ConTeacherTeaching/AddRoomOnline',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            //console.log(data);
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